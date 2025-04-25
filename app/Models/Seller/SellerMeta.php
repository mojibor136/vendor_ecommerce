<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Model;

class SellerMeta extends Model {
    protected $fillable = [
        'seller_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    public function seller() {
        return $this->belongsTo( Seller::class );
    }
}
