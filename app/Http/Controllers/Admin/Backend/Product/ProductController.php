<?php

namespace App\Http\Controllers\Admin\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\BackEnd\Category;
use App\Models\BackEnd\SubCategory;
use App\Models\BackEnd\Product;
use App\Models\Seller\Seller;

class ProductController extends Controller {
    // Index Page

    public function index() {
        return view( 'admin.backend.product.index' );
    }

    // API for product search/filter

    public function api( Request $request ) {
        $query  = $request->input( 'search' );
        $status = $request->input( 'status' );

        $products = Product::with( 'category' )
        ->when( $query, fn( $q ) => $q->where( 'product_name', 'LIKE', "%$query%" ) )
        ->when( $status, fn( $q ) => $q->where( 'product_status', $status ) )
        ->paginate( 10 );

        return response()->json( $products );
    }

    // Show Create Page

    public function create() {
        $categories = Category::all();
        return view( 'admin.backend.product.create', compact( 'categories' ) );
    }

    // Show Single Product

    public function show( $id ) {
        $product = Product::with( 'category', 'subcategory', 'seller' )->findOrFail( $id );
        return view( 'admin.backend.product.show', compact( 'product' ) );
    }

    // Show Edit Page

    public function edit( $id ) {
        $categories    = Category::all();
        $subcategories = SubCategory::all();
        $product       = Product::with( 'category', 'subcategory' )->findOrFail( $id );

        return view( 'admin.backend.product.edit', compact( 'product', 'categories', 'subcategories' ) );
    }

    // Delete Product

    public function destroy( $id ) {
        $product = Product::findOrFail( $id );

        Category::findOrFail( $product->category_id )->decrement( 'product_count', 1 );
        SubCategory::findOrFail( $product->subcategory_id )->decrement( 'product_count', 1 );

        $product->delete();

        return redirect()->route( 'products.index' )->with( 'success', 'Product deleted successfully.' );
    }

    // Store New Product

    public function store( Request $request ) {
        try {
            $validatedData = $request->validate( [
                'product_name'        => 'required|string|max:255',
                'product_description' => 'required|string',
                'product_price'       => 'required|numeric|min:0',
                'product_quantity'    => 'required|integer|min:1',
                'category_id'         => 'required',
                'subcategory_id'      => 'required',
                'product_size'        => 'nullable|string',
                'meta_tags'           => 'nullable|string',
                'optimized_image'     => 'required|string',
                'multiple_image'      => 'array',
                'multiple_image.*'    => 'image',
            ] );

            // Main Image Upload
            $base64 = $request->optimized_image;
            preg_match( '/data:image\/webp;base64,(.*)/', $base64, $matches );

            if ( !isset( $matches[ 1 ] ) ) {
                return back()->withInput()->with( 'error', 'Invalid image format.' );
            }

            $imageData = base64_decode( $matches[ 1 ] );
            $imageName = Str::random( 7 ) . '.webp';
            $imagePath = "product/{$imageName}";

            Storage::disk( 'public' )->put( $imagePath, $imageData );

            // Multiple Images Upload
            $multipleImagePaths = [];
            if ( $request->has( 'optimized_multiple_images' ) ) {
                $images = json_decode( $request->optimized_multiple_images, true );
                foreach ( $images as $base64 ) {
                    preg_match( '/data:image\/webp;base64,(.*)/', $base64, $matches );
                    if ( !isset( $matches[ 1 ] ) ) continue;

                    $imageData = base64_decode( $matches[ 1 ] );
                    $imageName = Str::random( 7 ) . '.webp';
                    $path = "product/{$imageName}";
                    Storage::disk( 'public' )->put( $path, $imageData );
                    $multipleImagePaths[] = $path;
                }
            }

            $sizesArray = $validatedData[ 'product_size' ] ? explode( ', ', $validatedData[ 'product_size' ] ) : [];
            $tagsArray  = $validatedData[ 'meta_tags' ] ? explode( ', ', $validatedData[ 'meta_tags' ] ) : [];

            $product = new Product( [
                'product_name'     => $validatedData[ 'product_name' ],
                'product_desc'     => $validatedData[ 'product_description' ],
                'product_price'    => $validatedData[ 'product_price' ],
                'product_quantity' => $validatedData[ 'product_quantity' ],
                'category_id'      => $validatedData[ 'category_id' ],
                'subcategory_id'   => $validatedData[ 'subcategory_id' ],
                'product_size'     => json_encode( $sizesArray ),
                'meta_tags'        => json_encode( $tagsArray ),
                'product_image'    => $imagePath,
                'multiple_image'   => json_encode( $multipleImagePaths ),
                'role'             => 'admin',
                'product_status'   => 'pending',
                'author_id'        => auth()->guard( 'admin' )->id(),
                'order_count'      => 0,
                'click_count'      => 0,
            ] );

            $product->save();

            Category::findOrFail( $request->category_id )->increment( 'product_count', 1 );
            SubCategory::findOrFail( $request->subcategory_id )->increment( 'product_count', 1 );

            return redirect()->route( 'products.index' )->with( 'success', 'Product created successfully' );
        } catch ( \Exception $e ) {
            return redirect()->back()->withInput()->with( 'error', 'Something went wrong: ' . $e->getMessage() );
        }
    }

    // Update Existing Product

    public function update( Request $request ) {
        $product = Product::findOrFail( $request->id );

        $request->validate( [
            'product_name'        => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price'       => 'required|numeric|min:0',
            'product_quantity'    => 'required|integer|min:1',
            'category_id'         => 'required',
            'subcategory_id'      => 'required',
        ] );

        $oldCategory    = $product->category_id;
        $oldSubCategory = $product->subcategory_id;

        $product->update( [
            'product_name'     => $request->product_name,
            'product_desc'     => $request->product_description,
            'product_price'    => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'author_id'        => auth()->guard( 'admin' )->id(),
            'role'             => 'admin',
            'product_status'   => 'pending',
        ] );

        // Replace Main Image
        if ( $request->filled( 'optimized_image' ) ) {
            if ( $product->product_image && Storage::disk( 'public' )->exists( $product->product_image ) ) {
                Storage::disk( 'public' )->delete( $product->product_image );
            }

            preg_match( '/data:image\/webp;base64,(.*)/', $request->optimized_image, $matches );
            if ( !isset( $matches[ 1 ] ) ) {
                return back()->withInput()->with( 'error', 'Invalid image format.' );
            }

            $imageData = base64_decode( $matches[ 1 ] );
            $imageName = Str::random( 7 ) . '.webp';
            $path      = "product/{$imageName}";
            Storage::disk( 'public' )->put( $path, $imageData );
            $product->update( [ 'product_image' => $path ] );
        }

        // Replace Multiple Images
        if ( $request->filled( 'optimized_multiple_images' ) ) {
            try {
                if ( $product->multiple_image ) {
                    foreach ( json_decode( $product->multiple_image, true ) as $oldImg ) {
                        if ( Storage::disk( 'public' )->exists( $oldImg ) ) {
                            Storage::disk( 'public' )->delete( $oldImg );
                        }
                    }
                }

                $paths = [];
                $images = json_decode( $request->optimized_multiple_images, true );
                foreach ( $images as $base64 ) {
                    preg_match( '/data:image\/webp;base64,(.*)/', $base64, $matches );
                    if ( !isset( $matches[ 1 ] ) ) continue;

                    $data = base64_decode( $matches[ 1 ] );
                    $name = Str::random( 7 ) . '.webp';
                    $path = "product/{$name}";

                    if ( Storage::disk( 'public' )->put( $path, $data ) ) {
                        $paths[] = $path;
                    }
                }

                if ( count( $paths ) > 0 ) {
                    $product->update( [ 'multiple_image' => json_encode( $paths ) ] );
                }
            } catch ( \Exception $e ) {
                return back()->with( 'error', 'Error updating multiple images: ' . $e->getMessage() );
            }
        }

        // Adjust Category/Subcategory Counts
        if ( $oldCategory != $request->category_id ) {
            Category::findOrFail( $oldCategory )->decrement( 'product_count' );
            Category::findOrFail( $request->category_id )->increment( 'product_count' );
        }

        if ( $oldSubCategory != $request->subcategory_id ) {
            SubCategory::findOrFail( $oldSubCategory )->decrement( 'product_count' );
            SubCategory::findOrFail( $request->subcategory_id )->increment( 'product_count' );
        }

        return redirect()->route( 'products.index' )->with( 'success', 'Product updated successfully' );
    }

    // Show Stock Management Page

    public function addStock( Request $request ) {
        $product = null;
        if ( $request->has( 'ProductId' ) ) {
            $request->validate( [ 'ProductId' => 'required|integer' ] );
            $product = Product::find( $request->ProductId );
        }

        return view( 'admin.backend.product.stock', compact( 'product' ) );
    }

    // Update Stock Quantity

    public function updateStock( Request $request ) {
        $request->validate( [
            'id'       => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ] );

        try {
            $product = Product::findOrFail( $request->id );
            $product->increment( 'product_quantity', $request->quantity );

            return redirect()->back()->with( 'success', 'Stock updated successfully' );
        } catch ( \Exception $e ) {
            return redirect()->back()->with( 'error', 'Error updating stock: ' . $e->getMessage() );
        }
    }
}
