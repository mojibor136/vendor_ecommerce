<?php

namespace App\Http\Controllers\Seller\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Category;
use App\Models\BackEnd\SubCategory;

class CategoryController extends Controller {
    public function index(Request $request) {
        return view( 'seller.backend.category.index' );
    }

    public function api(Request $request)
    {
        $query = $request->input('search');
        $sellerId = auth()->guard('seller')->id();
    
        $categories = Category::withCount([
            'products as seller_products_count' => function ($q) use ($sellerId) {
                $q->where('product_status', 'approved')
                  ->where('author_id', $sellerId);
            }
        ])
        ->when($query, function ($q) use ($query) {
            return $q->where('category_name', 'LIKE', "%$query%");
        })
        ->latest()
        ->paginate(7);
    
        return response()->json($categories);
    }      

    public function show($id) {
        $category = Category::findOrFail($id);
        return view( 'seller.backend.category.show' ,compact('category') );
    }
}
