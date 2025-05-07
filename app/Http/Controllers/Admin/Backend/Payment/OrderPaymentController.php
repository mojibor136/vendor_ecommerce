<?php

namespace App\Http\Controllers\Admin\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment\OrderPayment;
use Illuminate\Support\Facades\Log;

class OrderPaymentController extends Controller {
    public function index() {
        return view( 'admin.backend.payment.order_payment.index' );
    }
    
    public function api(Request $request) {
        $method = $request->input('method');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $payments = OrderPayment::with('order')
            ->when($method, fn($query) => $query->where('method', $method))
            ->when($startDate, fn($query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn($query) => $query->whereDate('created_at', '<=', $endDate))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($payment) {
                $payment->formatted_date = $payment->created_at->format('Y-m-d');
                return $payment;
            });

        return response()->json($payments);
    }
    
}
