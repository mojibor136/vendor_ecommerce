<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Model;

class SellerSocial extends Model {
    protected $fillable = [
        'seller_id',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
    ];

    public function seller() {
        return $this->belongsTo( Seller::class );
    }
}
