<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Product;

class HomeController extends Controller {
    public function index() {
        $products = Product::all();
        return view( 'frontend.welcome', compact( 'products' ) );
    }
}
