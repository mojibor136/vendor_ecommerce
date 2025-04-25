<?php

namespace App\Models\Backend\Location;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Shipping;

class Country extends Model {
    protected $fillable = [
        'name',
        'division_count',
    ];

    public function divisions() {
        return $this->hasMany( Division::class );
    }

    protected static function booted()
    {
        static::deleting(function ($country) {
            $country->divisions()->delete();
        });   
    }

    public function shippings()
    {
        return $this->hasMany( Shipping::class, 'shipping_country_id');
    }
    
}
