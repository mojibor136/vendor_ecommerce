<?php

namespace App\Http\Controllers\Admin\BackEnd\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function show( $shop_name, $orderId ) {
        dd( $orderId );
    }
}
