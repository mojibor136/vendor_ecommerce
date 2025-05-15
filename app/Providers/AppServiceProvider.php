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

        // Only 1 active shop found
        $shop = Seller::select( 'id', 'shop_logo', 'shop_name' )
        ->where( 'status', 'active' )
        ->first();

        $topShops = collect();

        if ( $shop ) {
            for ( $i = 0; $i < 16; $i++ ) {
                $copy = clone $shop;
                $topShops->push( $copy );
            }
        }

        View::share( 'topCategories', $topCategories );
        View::share( 'topShops', $topShops );
    }

}
