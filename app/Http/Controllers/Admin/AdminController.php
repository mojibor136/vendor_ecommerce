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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
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

        $newOrder = Order::with('orderItems.product', 'payment', 'shipping')
            ->latest()
            ->limit(5)
            ->get();

        $latestOrder = Order::with('orderItems.product.category', 'payment', 'shipping')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.backend.dashboard', compact(
            'productCount',
            'subCategoryCount',
            'categoryCount',
            'orderCount',
            'newOrder',
            'sellerCount',
            'latestOrder',
            'subscriptionCount',
            'userCount',
            'visitorCount',
            'countryCount',
            'divisionCount',
            'districtCount',
            'totalProductsSold',
            'totalProductQuantity',
        ));
    }

    public function getOneWeeklySalesData()
    {
        $start = Carbon::now()->subDays(7)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $orders = Order::with('payment')
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->map(function ($order) {
                return [
                    'created_at' => $order->created_at,
                    'amount' => $order->payment ? $order->payment->amount : 0,
                ];
            });

        return response()->json($orders);
    }

    public function getMonthlySalesData()
    {
        $start = Carbon::now()->subMonth()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $orders = Order::with('payment')
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->map(function ($order) {
                return [
                    'created_at' => $order->created_at,
                    'amount' => $order->payment ? $order->payment->amount : 0,
                ];
            });

        return response()->json($orders);
    }

    public function getYearlySalesData()
    {
        $start = Carbon::now()->subYear()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $orders = Order::with('payment')
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->map(function ($order) {
                return [
                    'created_at' => $order->created_at,
                    'amount' => $order->payment ? $order->payment->amount : 0,
                ];
            });

        return response()->json($orders);
    }
}
