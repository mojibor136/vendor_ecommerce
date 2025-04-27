<?php

namespace App\Http\Controllers\Admin\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment\PaymentGateway;

class PaymentGatewayController extends Controller {
    public function index() {
        $gateways = PaymentGateway::all();
        return view( 'admin.backend.payment.payment_gateway.index', compact( 'gateways' ) );
    }

    public function create() {
        return view( 'admin.backend.payment.payment_gateway.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'gateway_name' => 'required|unique:payment_gateways,gateway_name',
            'app_key'      => 'required|string',
            'app_secret'   => 'required|string',
            'username'     => 'required|string',
            'password'     => 'required|string',
        ] );

        $credentials = [
            'app_key'    => $request->app_key,
            'app_secret' => $request->app_secret,
            'username'   => $request->username,
            'password'   => $request->password,
        ];

        PaymentGateway::create( [
            'gateway_name' => $request->gateway_name,
            'credentials'  => $credentials,
            'is_active'    => $request->has( 'is_active' ) ? true : false,
        ] );

        return redirect()->route( 'payment-gateway.index' )->with( 'success', 'Payment Gateway added successfully.' );
    }

    public function edit( $id ) {
        $payment_gateway = PaymentGateway::findOrFail( $id );
        return view( 'admin.backend.payment.payment_gateway.edit', compact( 'payment_gateway' ) );
    }

    public function update( Request $request ) {
        $request->validate( [
            'gateway_name' => 'required|unique:payment_gateways,gateway_name,' . $request->id,
            'app_key'      => 'required|string',
            'app_secret'   => 'required|string',
            'username'     => 'required|string',
            'password'     => 'required|string',
            'is_active' => 'required|in:0,1',
        ] );

        $credentials = [
            'app_key'    => $request->app_key,
            'app_secret' => $request->app_secret,
            'username'   => $request->username,
            'password'   => $request->password,
        ];

        $payment_gateway = PaymentGateway::findOrFail( $request->id );

        $payment_gateway->update( [
            'gateway_name' => $request->gateway_name,
            'credentials'  => $credentials,
            'is_active' => $request->is_active === '1',
        ] );

        return redirect()->route( 'payment-gateway.index' )->with( 'success', 'Payment Gateway updated successfully.' );
    }

    public function destroy( $id ) {
        PaymentGateway::findOrFail( $id )->delete();
        return redirect()->route( 'payment-gateway.index' )->with( 'success', 'Payment Gateway deleted successfully.' );
    }
}
