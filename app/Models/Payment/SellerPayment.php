<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class SellerPayment extends Model {
    protected $fillable = [
        'shop',
        'amount',
        'paid_at',
        'method',
        'status',
        'order_id',
        'seller_id'
    ];
}
