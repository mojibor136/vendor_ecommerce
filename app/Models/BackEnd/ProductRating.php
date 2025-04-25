<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRating extends Model {
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'rating',
        'comment',
        'image',
        'is_approved',
    ];

    // Relationships

    public function user(): BelongsTo {
        return $this->belongsTo( User::class );
    }

    public function product(): BelongsTo {
        return $this->belongsTo( Product::class );
    }

    public function order(): BelongsTo {
        return $this->belongsTo( Order::class );
    }
}
