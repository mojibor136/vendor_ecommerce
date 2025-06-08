<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Slider;
use Illuminate\Support\Facades\Log;

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

        $mainSliders = Slider::where( 'type', 'main' )
        ->where( 'status', 1 )
        ->where( 'author_type', 'Admin' )
        ->latest()
        ->take( 5 )
        ->get();

        $subSliders = Slider::where( 'type', 'sub' )
        ->where( 'status', 1 )
        ->where( 'author_type', 'Admin' )
        ->latest()
        ->take( 5 )
        ->get();

        return view( 'frontend.welcome', compact( 'products', 'mainSliders', 'subSliders' ) );
    }

    public function product( $product, $id ) {
        $product = Product::find( $id );
        return view( 'frontend.show', compact( 'product' ) );
    }
}
