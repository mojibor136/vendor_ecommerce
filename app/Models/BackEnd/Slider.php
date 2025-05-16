<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Slider extends Model {

    const AUTHOR_TYPE_ADMIN = 'App\Models\Admin\Admin';
    const AUTHOR_TYPE_SELLER = 'App\Models\Seller\Seller';

    protected $fillable = [
        'images',
        'type',
        'link',
        'author_id',
        'author_type',
        'status',
    ];

    public function author(): MorphTo {
        return $this->morphTo();
    }
}
