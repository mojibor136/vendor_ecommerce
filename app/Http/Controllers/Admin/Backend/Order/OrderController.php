<?php

namespace App\Http\Controllers\Admin\BackEnd\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\Order;

class OrderController extends Controller {
    public function api(Request $request)
    {
        $query = $request->input('search');
        $status = $request->input('status');
    
        $orders = Order::with(['shipping', 'shipping'])
            ->when($query, function ($q) use ($query) {
                $q->where('id', 'LIKE', "%$query%")
                    ->orWhereHas('shipping', function ($q2) use ($query) {
                        $q2->where('shipping_name', 'LIKE', "%$query%");
                    });
            })
            ->when($status, function ($q) use ($status) {
                return $q->where('order_status', $status);
            })
            ->latest()
            ->paginate(7);
    
        return response()->json($orders);
    }      

    public function index() {
        return view( 'admin.backend.order.index' );
    }

    public function shipping() {
        return view( 'admin.backend.order.shipping' );
    }

    public function cancel() {
        return view( 'admin.backend.order.cancel' );
    }

    public function delivered() {
        return view( 'admin.backend.order.delivered' );
    }

    public function show( $shop_name, $orderId ) {
        dd( $orderId );
    }
}
