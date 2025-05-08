<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Payment\SubscriptionPayment;

class Subscription extends Model {
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_limit',
        'duration_days',
        'features',
        'sells',
        'is_active',
    ];

    public function sellerSubscriptions() {
        return $this->hasMany( SellerSubscription::class );
    }

    public function payments() {
        return $this->hasMany( SubscriptionPayment::class );
    }

}
