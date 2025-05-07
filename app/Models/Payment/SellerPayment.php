<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Order;
use App\Models\Seller\Seller;

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

    public function order() {
        return $this->belongsTo( Order::class );
    }

    public function seller() {
        return $this->belongsTo( Seller::class );
    }
}
