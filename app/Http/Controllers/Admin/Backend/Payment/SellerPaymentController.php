<?php

namespace App\Http\Controllers\Admin\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment\SellerPayment;

class SellerPaymentController extends Controller {
    public function index() {
        return view( 'admin.backend.payment.seller_payment.index' );
    }

    public function api() {
        $payments = SellerPayment::paginate( 10 );
        return response()->json( $payments );
    }

    public function show( $id ) {
        return view( 'admin.backend.payment.seller_payment.show' );
    }
}
