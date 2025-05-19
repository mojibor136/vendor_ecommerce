<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\BackEnd\Slider;

class Admin extends Authenticatable {
    protected $fillable = [ 'image', 'name', 'phone', 'email', 'password', 'status' ];

    public function sliders(): MorphMany {
        return $this->morphMany( Slider::class, 'author' );
    }
}

