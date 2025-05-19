<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Seller\Seller;

class Slider extends Model {

    protected $fillable = [
        'images',
        'type',
        'link',
        'author_id',
        'author_type',
        'status',
    ];

    public function getAuthorNameAttribute() {
        if ( $this->author_type === 'admin' ) {
            return 'Admin';
        }

        if ( $this->author_type === 'seller' ) {
            $seller = Seller::find( $this->author_id );
            return $seller ? $seller->shop_name : 'Unknown Seller';
        }

        return 'Unknown';
    }
}
