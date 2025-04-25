<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model {
    protected $fillable = [
        'subcategory_name',
        'category_id',
        'product_count',
        'slug',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo( Category::class, 'category_id' );
    }

    public function products() {
        return $this->hasMany( Product::class, 'subcategory_id' );
    }
}
