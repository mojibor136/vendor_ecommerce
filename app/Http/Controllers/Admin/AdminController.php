<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\SubCategory;
use App\Models\BackEnd\Category;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use App\Models\Subscription\Subscription;
use App\Models\User;
use App\Models\Visitor\Visitor;
use App\Models\Backend\Location\Division;
use App\Models\Backend\Location\District;
use App\Models\Backend\Location\Country;
use App\Models\Order\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {
    public function index() {
        $productCount = Product::count();
        $totalProductQuantity = Product::sum('product_quantity');
        $subCategoryCount = SubCategory::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $sellerCount = Seller::count();
        $subscriptionCount = Subscription::count();
        $userCount = User::count();
        $visitorCount = Visitor::count();
        $countryCount = Country::count();
        $divisionCount = Division::count();
        $districtCount = District::count();
        $totalProductsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('order_status', 'delivered');
        })->sum('quantity');

        return view( 'admin.backend.dashboard', compact(
            'productCount',
            'subCategoryCount',
            'categoryCount',
            'orderCount',
            'sellerCount',
            'subscriptionCount',
            'userCount',
            'visitorCount',
            'countryCount',
            'divisionCount',
            'districtCount',
            'totalProductsSold',
            'totalProductQuantity',
        ) );
    }
}
