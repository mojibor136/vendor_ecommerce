<?php

namespace App\Http\Controllers\Admin\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment\OrderPayment;

class OrderPaymentController extends Controller {
    public function index() {
        return view( 'admin.backend.payment.order_payment.index' );
    }

    public function api() {
        $payments = OrderPayment::paginate( 10 );
        return response()->json( $payments );
    }
}
