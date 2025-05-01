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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping'])
        ->when($query, function ($q) use ($query) {
            $q->where(function ($q2) use ($query) {
                $q2->where('id', 'LIKE', "%$query%")
                   ->orWhereHas('shipping', function ($q3) use ($query) {
                       $q3->where('shipping_name', 'LIKE', "%$query%");
                   });
            });
        })
        ->when($status, function ($q) use ($status) {
            return $q->where('order_status', $status);
        })
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })
        ->latest()
        ->paginate(7);    
    
        return response()->json($orders);
    }      

    public function deliveredApi(Request $request)
    {
        $query = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping'])
            ->where('order_status', 'delivered')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('id', 'LIKE', "%$query%")
                        ->orWhereHas('shipping', function ($q3) use ($query) {
                            $q3->where('shipping_name', 'LIKE', "%$query%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->latest()
            ->paginate(7);
    
        return response()->json($orders);
    } 
    
    public function shippedApi(Request $request)
    {
        $query = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping'])
            ->where('order_status', 'shipped')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('id', 'LIKE', "%$query%")
                        ->orWhereHas('shipping', function ($q3) use ($query) {
                            $q3->where('shipping_name', 'LIKE', "%$query%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->latest()
            ->paginate(7);
    
        return response()->json($orders);
    }

    public function cancelledApi(Request $request)
    {
        $query = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping'])
            ->where('order_status', 'cancelled')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('id', 'LIKE', "%$query%")
                        ->orWhereHas('shipping', function ($q3) use ($query) {
                            $q3->where('shipping_name', 'LIKE', "%$query%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
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
