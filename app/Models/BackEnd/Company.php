<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    protected $fillable = [
        'name',
        'address',
        'fax',
        'phone',
        'email',
        'company',
        'logo',
        'icon',
    ];
}
