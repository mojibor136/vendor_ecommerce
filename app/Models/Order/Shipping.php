<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Location\Country;
use App\Models\Backend\Location\Division;
use App\Models\Backend\Location\District;

class Shipping extends Model {
    protected $fillable = [
        'order_id',
        'shipping_name',
        'shipping_email',
        'shipping_address',
        'shipping_division_id',
        'shipping_district_id',
        'shipping_country_id',
        'shipping_phone',
        'shipping_status',
    ];

    // Each Shipping belongs to one Order

    public function order() {
        return $this->belongsTo( Order::class );
    }

    // Shipping belongs to Country

    public function country() {
        return $this->belongsTo( Country::class, 'shipping_country_id' );
    }

    // Shipping belongs to Division

    public function division() {
        return $this->belongsTo( Division::class, 'shipping_division_id' );
    }

    // Shipping belongs to District

    public function district() {
        return $this->belongsTo( District::class, 'shipping_district_id' );
    }
}
