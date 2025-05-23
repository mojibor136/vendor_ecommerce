<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Category;
use App\Models\Seller\Seller;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller {
    public function getSearchData(Request $request) {
        $model = $request->input('model');
        $query = $request->input('query', '');

        $data = [];

        if ($model == 'products') {
            $data['products'] = Product::where('product_name', 'like', "%{$query}%")
                ->limit(8)    
                ->get()
                ->map(function($product) {
                    $product->name = $product->product_name;
                    $product->image = asset('storage/' . $product->product_image);
                    return $product;
                });
        }
        elseif ($model == 'categories') {
            $data['categories'] = Category::where('category_name', 'like', "%{$query}%")
                ->limit(8)    
                ->get()
                ->map(function($category) {
                    $category->name = $category->category_name;
                    $category->image = asset('storage/' . $category->category_img);
                    return $category;
                });
        }
        elseif ($model == 'sellers') {
            $data['sellers'] = Seller::where('shop_name', 'like', "%{$query}%")
                ->limit(8)    
                ->get()
                ->map(function($seller) {
                    $seller->name = $seller->shop_name;
                    $seller->image = asset('storage/' . $seller->shop_logo);
                    return $seller;
                });
        }

        return response()->json($data);
    }
}


