<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model {
    protected $fillable = [
        'order_id',
        'method',
        'status',
        'transaction_id',
        'gateway_response',
        'paid_at',
        'amount',
    ];

    public function order() {
        return $this->belongsTo( Order::class );
    }
}
