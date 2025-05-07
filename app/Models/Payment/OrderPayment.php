<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Order;

class OrderPayment extends Model {
    protected $fillable = [
        'order_id',
        'method',
        'status',
        'transaction_id',
        'gateway_response',
        'amount',
    ];

    public function order() {
        return $this->belongsTo( Order::class );
    }
}
