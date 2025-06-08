<?php

namespace App\Http\Controllers\Admin\Backend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller {
    public function paymentIntegration() {
        return view( 'admin.backend.api.payment' );
    }

    public function courierIntegration() {
        return view( 'admin.backend.api.courier' );
    }

    public function pixelIntegration() {
        return view( 'admin.backend.api.pixel' );
    }

    public function gtagIntegration() {
        return view( 'admin.backend.api.gtag' );
    }

    public function smsIntegration() {
        return view( 'admin.backend.api.sms' );
    }

    public function emailIntegration() {
        return view( 'admin.backend.api.email' );
    }
}
