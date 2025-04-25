<?php

namespace App\Models\Backend\Location;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Shipping;

class Division extends Model {
    protected $fillable = [
        'name',
        'country_id',
        'district_count'
    ];

    // Relationship: Division belongs to Country

    public function country() {
        return $this->belongsTo( Country::class );
    }

    // Relationship: Division has many Districts

    public function districts() {
        return $this->hasMany( District::class );
    }

    public function shippings() {
        return $this->hasMany( Shipping::class, 'shipping_division_id' );
    }
}
