<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Product;

class HomeController extends Controller {
    public function index() {
        $product = Product::select( 'id', 'product_name', 'product_price', 'product_image' )->first();

        $products = collect();

        if ( $product ) {
            for ( $i = 0; $i < 15; $i++ ) {
                $copy = clone $product;
                $products->push( $copy );
            }
        }
        return view( 'frontend.welcome', compact( 'products' ) );
    }

    public function product( $product, $id ) {
        $product = Product::find( $id );
        return view( 'frontend.show', compact( 'product' ) );
    }
}
