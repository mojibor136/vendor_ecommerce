<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Slider extends Model {
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
