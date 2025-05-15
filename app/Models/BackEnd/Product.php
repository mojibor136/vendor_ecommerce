<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Seller\Seller;
use Illuminate\Support\Str;

class Product extends Model {
    protected $fillable = [
        'product_name',
        'product_desc',
        'product_price',
        'product_quantity',
        'category_id',
        'subcategory_id',
        'product_size',
        'product_status',
        'product_image',
        'multiple_image',
        'rating',
        'meta_tag',
        'author_id',
        'role',
        'click_count',
        'order_count',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo( Category::class, 'category_id' );
    }

    public function subcategory(): BelongsTo {
        return $this->belongsTo( SubCategory::class, 'subcategory_id' );
    }

    public function seller(): BelongsTo {
        return $this->belongsTo( Seller::class, 'author_id' );
    }

    public function ratings(): HasMany {
        return $this->hasMany( ProductRating::class );
    }

    public function approvedRatings() {
        return $this->hasMany( ProductRating::class )->where( 'is_approved', true );
    }

    public function getSlugAttribute() {
        return Str::limit( Str::slug( $this->product_name ), 20, '' );
    }

    protected $casts = [
        'meta_tag' => 'array',
        'product_size' => 'array',
        'multiple_image' => 'array',
    ];
}
