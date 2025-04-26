<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model {
    protected $fillable = [ 'gateway_name', 'credentials', 'is_active' ];

    protected $casts = [
        'credentials' => 'array',
    ];
}
