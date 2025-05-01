<?php

namespace App\Http\Controllers\Admin\BackEnd\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\Order;
use App\Models\Seller\Seller;

class OrderController extends Controller {
    public function api(Request $request)
    {
        $query = $request->input('search');
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping' , 'seller' , 'payment'])
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
    
        $orders = Order::with(['shipping' , 'seller' , 'payment'])
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
    
        $orders = Order::with(['shipping' , 'seller' , 'payment'])
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
    
        $orders = Order::with(['shipping' , 'seller' , 'payment'])
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

    public function processingApi(Request $request)
    {
        $query = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = Order::with(['shipping' , 'seller' , 'payment'])
            ->where('order_status', 'processing')
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

    public function processing() {
        return view( 'admin.backend.order.processing' );
    }

    public function show($shop_id, $shop_name)
    {
        $order = Order::with([
            'shipping.country', 'shipping.division', 'shipping.district',
            'seller.country', 'seller.division', 'seller.district',
            'orderItems', 'payment'
        ])->findOrFail($shop_id);
    
        return view('admin.backend.order.view', compact("order"));
    }

    public function status(Request $request)
    {
        try {
            $order = Order::find($request->id);
            
            if (!$order) {
                return redirect()->back()->with('error', 'Order not found.');
            }
    
            $order->order_status = $request->status;
            $order->save();    
    
            return redirect()->back()->with('success', 'Order status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the order status: ' . $e->getMessage());
        }
    }    
    
    public function manual(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'courier_name' => 'required|string',
                'tracking_number' => 'required',
            ]);
    
            $order = Order::findOrFail($request->id);
            $order->order_status = 'shipped';
            $order->courier_name = $request->courier_name;
            $order->tracking_number = $request->tracking_number;
            $order->is_manual_tracking = 1;
            $order->save();
    
            return redirect()->back()->with('success', 'Order status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }    

    public function auto(Request $request)
    {
        dd($request->all());
    } 
}
