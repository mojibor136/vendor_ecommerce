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
            'credentials' => 'required|array',
        ] );

        PaymentGateway::create( [
            'gateway_name' => $request->gateway_name,
            'credentials' => $request->credentials,
            'is_active' => $request->is_active ?? true,
        ] );

        return redirect()->route( 'payment-gateways.index' )->with( 'success', 'Payment Gateway added successfully.' );
    }

    public function edit( PaymentGateway $payment_gateway ) {
        return view( 'admin.backend.payment.payment_gateway.edit', compact( 'payment_gateway' ) );
    }

    public function update( Request $request, PaymentGateway $payment_gateway ) {
        $request->validate( [
            'gateway_name' => 'required|unique:payment_gateways,gateway_name,' . $payment_gateway->id,
            'credentials' => 'required|array',
        ] );

        $payment_gateway->update( [
            'gateway_name' => $request->gateway_name,
            'credentials' => $request->credentials,
            'is_active' => $request->is_active ?? true,
        ] );

        return redirect()->route( 'payment-gateways.index' )->with( 'success', 'Payment Gateway updated successfully.' );
    }

    public function destroy( PaymentGateway $payment_gateway ) {
        $payment_gateway->delete();
        return redirect()->route( 'payment-gateways.index' )->with( 'success', 'Payment Gateway deleted successfully.' );
    }
}
