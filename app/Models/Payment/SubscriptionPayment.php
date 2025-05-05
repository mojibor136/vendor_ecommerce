<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model {
    protected $fillable = [
        'seller_id',
        'subscription_id',
        'transaction_id',
        'method',
        'amount',
    ];
}
