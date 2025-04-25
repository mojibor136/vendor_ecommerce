<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller\Seller;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Location\Country;

class SellerAuthController extends Controller {
    public function index() {
        if ( Auth::guard( 'seller' )->check() ) {
            return redirect()->route( 'seller.dashboard' );
        }
        return view( 'seller.auth.login' );
    }

    public function create() {
        $countries = Country::all();
        return view( 'seller.auth.register', compact( 'countries' ) );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:255|unique:sellers,name',
            'email' => 'required|email|max:255|unique:sellers,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|string|max:20|unique:sellers,phone',
            'shop_name' => 'required|string|max:255|unique:sellers,shop_name',
            'shop_description' => 'required|string',
            'shop_address' => 'required',
            'district_id' => 'required',
            'division_id' => 'required',
            'country_id' => 'required',
            'shop_logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'shop_banner' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nid_front_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nid_back_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ] );

        // Image Uploads
        $validated[ 'image' ] = $request->file( 'image' )->store( 'sellers/images', 'public' );
        $validated[ 'shop_logo' ] = $request->file( 'shop_logo' )->store( 'sellers/logo', 'public' );
        $validated[ 'shop_banner' ] = $request->file( 'shop_banner' )->store( 'sellers/banner', 'public' );
        $validated[ 'nid_front_image' ] = $request->file( 'nid_front_image' )->store( 'sellers/nid', 'public' );
        $validated[ 'nid_back_image' ] = $request->file( 'nid_back_image' )->store( 'sellers/nid', 'public' );

        // Password Hash
        $validated[ 'password' ] = Hash::make( $validated[ 'password' ] );

        // Create Seller
        Seller::create( $validated );

        return redirect()->route( 'seller.login' )->with( 'success', 'Seller account created successfully!' );
    }

    public function checkField( Request $request ) {
        $field = $request->field;
        $value = $request->value;

        $exists = Seller::where( $field, $value )->exists();

        if ( $exists ) {
            return response()->json( [ 'status' => 'error', 'message' => ucfirst( $field ).' already taken.' ] );
        }

        return response()->json( [ 'status' => 'success' ] );
    }

    public function login( Request $request ) {
        $request->validate( [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ] );

        if ( Auth::guard( 'seller' )->attempt( $request->only( 'email', 'password' ) ) ) {
            return redirect()->route( 'seller.dashboard' );
        }

        return back()->with( 'error', 'Invalid credentials' );
    }

    public function destroy() {
        Auth::guard( 'seller' )->logout();
        return redirect()->route( 'home' );
    }
}
