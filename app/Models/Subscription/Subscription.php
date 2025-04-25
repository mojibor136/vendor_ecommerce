<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_limit',
        'duration_days',
        'features',
        'sells',
    ];

    public function sellerSubscriptions() {
        return $this->hasMany( SellerSubscription::class );
    }
}
