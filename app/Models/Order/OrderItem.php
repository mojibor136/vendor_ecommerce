<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\BackEnd\Product;

class OrderItem extends Model {
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_size',
        'quantity',
        'price',
    ];

    // Each OrderItem belongs to one Order

    public function product() {
        return $this->belongsTo( Product::class );
    }

    public function order() {
        return $this->belongsTo( Order::class );
    }
}
