<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BackEnd\Product;
use Carbon\Carbon;
use App\Models\Seller\SellerSubscription;
use App\Models\Backend\Location\Country;
use App\Models\Backend\Location\Division;
use App\Models\Backend\Location\District;
use App\Models\Order\Order;

class Seller extends Authenticatable {
    protected $fillable = [
        'image', 'name', 'email', 'password',
        'phone', 'shop_name', 'shop_description', 'facebook_pixel_id',
        'shop_address', 'country_id', 'division_id', 'district_id', 'shop_logo', 'shop_banner', 'phone_verification',
        'nid_front_image', 'nid_back_image', 'verification_status', 'status',
    ];

    public function country() {
        return $this->belongsTo( Country::class );
    }

    public function division() {
        return $this->belongsTo( Division::class );
    }

    public function district() {
        return $this->belongsTo( District::class );
    }

    public function social() {
        return $this->hasOne( SellerSocial::class );
    }

    public function meta() {
        return $this->hasOne( SellerMeta::class );
    }

    public function subscriptions() {
        return $this->hasMany( SellerSubscription::class );
    }

    public function products(): HasMany {
        return $this->hasMany( Product::class, 'author_id' );
    }

    public function activeSubscription() {
        return $this->hasOne( SellerSubscription::class )->where( 'is_active', true );
    }

    public function orders(): HasMany {
        return $this->hasMany( Order::class, 'author_id' );
    }

    public function getSubscriptionStatusAttribute() {
        $subscription = $this->activeSubscription;

        if ( !$subscription ) {
            return 'inactive';
        }

        $now = Carbon::now();

        if ( $now->between( $subscription->start_date, $subscription->end_date ) ) {
            return 'active';
        }

        return 'inactive';
    }

}
