<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order\Shipping;

class CourierController extends Controller {
    public function check( Request $request ) {

        $orderId = $request->orderId;

        $phone = Shipping::where( 'order_id', $orderId )->value( 'shipping_phone' );

        $apiKey = 'nM4c51nyAar6036jTMfMyxXEPTTxPKXDwgJAgynb0jiSmwh6EIMTCKyxiMMa';

        $curl = curl_init();

        curl_setopt_array( $curl, [
            CURLOPT_URL => 'https://bdcourier.com/api/courier-check',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query( [ 'phone' => $phone ] ),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiKey",
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ] );

        $response = curl_exec( $curl );
        $error = curl_error( $curl );
        curl_close( $curl );

        $decodedResponse = json_decode( $response, true );

        $decodedResponse[ 'phone' ] = $phone;

        return redirect()->back()->with( 'response', $decodedResponse );
    }
}
