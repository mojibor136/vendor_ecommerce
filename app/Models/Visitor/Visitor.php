<?php

namespace App\Models\Visitor;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {
    protected $fillable = [
        'ip_address',
        'page_visited'
    ];

    public $timestamps = false;

    public static function storeVisitorInfo( $request ) {
        self::create( [
            'ip_address' => $request->ip(),
            'page_visited' => url()->current(),
        ] );
    }
}
