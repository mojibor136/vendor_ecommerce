<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller\Seller;
use App\Models\Subscription\Subscription;

class SubscriptionPayment extends Model {
    protected $fillable = [
        'seller_id',
        'subscription_id',
        'transaction_id',
        'method',
        'amount',
    ];

    public function seller() {
        return $this->belongsTo( Seller::class );
    }

    public function subscription() {
        return $this->belongsTo( Subscription::class );
    }
}
