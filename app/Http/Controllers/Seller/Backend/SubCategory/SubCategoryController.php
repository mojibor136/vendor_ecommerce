<?php

namespace App\Http\Controllers\Seller\Backend\SubCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\SubCategory;
use App\Models\BackEnd\Category;

class SubCategoryController extends Controller {
    public function index() {
        return view( 'seller.backend.sub-category.index' );
    }

    public function getSubCategories($id){
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    public function api(Request $request)
    {
        $query = $request->input('search');
        $sellerId = auth()->guard('seller')->id();
    
        $subcategories = SubCategory::with('category')
            ->withCount([
                'products as seller_products_count' => function ($q) use ($sellerId) {
                    $q->where('product_status', 'approved')
                      ->where('author_id', $sellerId);
                }
            ])
            ->when($query, function ($q) use ($query) {
                return $q->where('subcategory_name', 'LIKE', "%$query%");
            })
            ->latest()
            ->paginate(7);
    
        return response()->json($subcategories);
    }
    
    public function show($id) {
        $subcategory = SubCategory::findOrFail($id);
        return view( 'seller.backend.sub-category.show' , compact('subcategory'));
    }
}
