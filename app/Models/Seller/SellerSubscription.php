<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Subscription;

class SellerSubscription extends Model {
    protected $fillable = [
        'seller_id',
        'subscription_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function subscription() {
        return $this->belongsTo( Subscription::class );
    }

    public function seller() {
        return $this->belongsTo( Seller::class );
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
