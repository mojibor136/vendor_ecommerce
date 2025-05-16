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
        $topCategories = Category::with( 'subcategory' )
        ->withCount( 'products' )
        ->orderBy( 'products_count', 'desc' )
        ->take( 16 )
        ->get();

        // Random 10 categories from the above ( only id and category_name )
        $categories = $topCategories->shuffle()->take( 10 );

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

        // Share data to all views
        View::share( 'topCategories', $topCategories );
        View::share( 'categories', $categories );
        View::share( 'topShops', $topShops );
    }
}
