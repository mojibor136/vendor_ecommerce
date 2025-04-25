<?php

namespace App\Models\Backend\Location;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Shipping;

class District extends Model {
    protected $fillable = [
        'name',
        'division_id',
    ];

    // Relationship: District belongs to Division

    public function division() {
        return $this->belongsTo( Division::class );
    }

    public function shippings() {
        return $this->hasMany( Shipping::class, 'shipping_district_id' );
    }
}
