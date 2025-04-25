<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    protected $fillable = [
        'category_name',
        'category_img',
        'subcategory_count',
        'product_count',
        'slug',
    ];

    public function subcategory(): HasMany {
        return $this->hasMany( SubCategory::class, 'category_id' );
    }

    public function products(): HasMany {
        return $this->hasMany( Product::class, 'category_id' );
    }

}
