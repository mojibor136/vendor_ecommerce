<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\BackEnd\Category;
use App\Models\Seller\Seller;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {
    /**
    * Register any application services.
    */

    public function register(): void {
        //
    }

    /**
    * Bootstrap any application services.
    */

    public function boot(): void {
        Paginator::useTailwind();

        // Top categories with most products
        $topCategories = Category::withCount( 'products' )
        ->orderBy( 'products_count', 'desc' )
        ->take( 16 )
        ->get();

        // Top active shops
        $topShops = Seller::select( 'id', 'shop_logo', 'shop_name' )
        ->where( 'status', 'active' )
        ->take( 16 )
        ->get();

        View::share( 'topCategories', $topCategories );
        View::share( 'topShops', $topShops );
    }

}
