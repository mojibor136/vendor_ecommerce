<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller\Seller;
use App\Models\BackEnd\Product;
use App\Models\Payment\OrderPayment;

class Order extends Model {
    protected $fillable = [
        'author_id',
        'customer_id',
        'role',
        'order_status',
        'courier_name',
        'is_manual_tracking',
        'shipping_charge',
        'tracking_number',
    ];

    // Order has many OrderItems

    public function orderItems() {
        return $this->hasMany( OrderItem::class );
    }

    // Order has one Shipping

    public function shipping() {
        return $this->hasOne( Shipping::class );
    }

    public function products() {
        return $this->hasManyThrough( Product::class, OrderItem::class );
    }

    public function seller() {
        return $this->belongsTo( Seller::class, 'author_id' );
    }

    public function payment() {
        return $this->hasOne( OrderPayment::class, 'order_id' );
    }

}
