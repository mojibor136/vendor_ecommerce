<?php

namespace App\Http\Controllers\Admin\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment\SubscriptionPayment;

class SubscriptionPaymentController extends Controller {
    public function index() {
        return view( 'admin.backend.payment.subscription_payment.index' );
    }

    public function api() {
        $payments = SubscriptionPayment::paginate( 10 );
        return response()->json( $payments );
    }
}
