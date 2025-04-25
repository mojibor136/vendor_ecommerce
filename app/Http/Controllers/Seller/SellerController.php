<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller\Seller;
use App\Models\Subscription\Subscription;
use App\Models\Seller\SellerSubscription;

class SellerController extends Controller {
    public function dashboard() {
        return view( 'seller.backend.dashboard' );
    }

    public function destroy( $id ) {
        Seller::find( $id )->delete();
        return redirect()->back();
    }
}
