<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    protected $fillable = [ 'image', 'name', 'phone', 'email', 'password', 'status' ];
}
