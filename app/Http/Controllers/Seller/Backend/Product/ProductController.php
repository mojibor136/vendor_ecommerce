<?php

namespace App\Http\Controllers\Seller\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Category;
use App\Models\BackEnd\SubCategory;
use App\Models\BackEnd\Product;
use App\Models\Seller\Seller;

class ProductController extends Controller {
    public function index() {
        return view( 'seller.backend.product.index' );
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $products = Product::with('category')
            ->when($query, function ($q) use ($query) {
                return $q->where('product_name', 'LIKE', "%$query%");
            })
            ->paginate(10);

        return response()->json($products);
    }

    public function create() {
        $categories = Category::all();
        return view('seller.backend.product.create', compact('categories'));
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        Category::findOrFail($product->category_id)->decrement('product_count', 1);
        SubCategory::findOrFail($product->subcategory_id)->decrement('product_count', 1);
        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product deleted successfully.');
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view( 'seller.backend.product.show' , compact('product') );
    }

    public function edit($id) {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $product = Product::with('category', 'subcategory')->findOrFail($id);
        return view('seller.backend.product.edit', compact('product', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'required|string',
                'product_price' => 'required|numeric|min:0',
                'product_quantity' => 'required|integer|min:1',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'product_size' => 'nullable|string',
                'meta_tags' => 'nullable|string',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp',
                'multiple_image' => 'array',
                'multiple_image.*' => 'image',
            ]);
    
            $imagePath = $request->hasFile('image') ? $request->file('image')->store('product', 'public') : null;
    
            $multipleImagePaths = [];
            if ($request->has('multiple_image')) {
                foreach ($request->file('multiple_image', []) as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('product', 'public');
                        $multipleImagePaths[] = $path;
                    }
                }
            }
    
            $sizesArray = $validatedData['product_size'] ? explode(', ', $validatedData['product_size']) : [];
            $tagsArray = $validatedData['meta_tags'] ? explode(', ', $validatedData['meta_tags']) : [];
    
            $product = new Product([
                'product_name' => $validatedData['product_name'],
                'product_desc' => $validatedData['product_description'],
                'product_price' => $validatedData['product_price'],
                'product_quantity' => $validatedData['product_quantity'],
                'category_id' => $validatedData['category_id'],
                'subcategory_id' => $validatedData['subcategory_id'],
                'product_size' => json_encode($sizesArray),
                'meta_tags' => json_encode($tagsArray),
                'product_image' => $imagePath,
                'multiple_image' => json_encode($multipleImagePaths),
                'role' => 'seller',
                'author_id' => auth()->guard('seller')->id(),
                'order_count' => 0,
                'click_count' => 0,
            ]);
    
            $product->save();
    
            Category::findOrFail($request->category_id)->increment('product_count', 1);
            SubCategory::findOrFail($request->subcategory_id)->increment('product_count', 1);
    
            return redirect()->route('seller.products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the product: ' . $e->getMessage());
        }
    }    

    public function update(Request $request) {
        // Find the product by its ID
        $product = Product::findOrFail($request->id);

        // Validate incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|integer|min:1',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Store the old category and subcategory
        $oldCategory = $product->category_id;
        $oldSubCategory = $product->subcategory_id;

        // Update the product details
        $product->update([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_description,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'author_id' => auth()->guard('seller')->id(),
            'role' => 'seller',
        ]);

        // Handle product image upload
        if ($request->hasFile('image')) {
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }

            $imagePath = $request->file('image')->store('product', 'public');
            $product->update(['product_image' => $imagePath]);
        }

        // Handle multiple images upload
        if ($request->hasFile('multiple_image')) {
            if ($product->multiple_image) {
                foreach (json_decode($product->multiple_image, true) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $multipleImagePaths = [];
            foreach ($request->file('multiple_image') as $image) {
                if ($image->isValid()) {
                    $imagePath = $image->store('product', 'public');
                    $multipleImagePaths[] = $imagePath;
                }
            }

            $product->update(['multiple_image' => json_encode($multipleImagePaths)]);
        }

        // Update category and subcategory product count if changed
        if ($oldCategory != $request->category_id) {
            Category::findOrFail($oldCategory)->decrement('product_count', 1);
            Category::findOrFail($request->category_id)->increment('product_count', 1);
        }

        if ($oldSubCategory != $request->subcategory_id) {
            SubCategory::findOrFail($oldSubCategory)->decrement('product_count', 1);
            SubCategory::findOrFail($request->subcategory_id)->increment('product_count', 1);
        }

        // Redirect back with success message
        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully');
    }
}
