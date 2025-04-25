<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller {
    public function index() {
        if ( Auth::guard( 'admin' )->check() ) {
            return redirect()->route( 'admin.index' );
        }

        return view( 'admin.auth.login' );
    }

    public function login( Request $request ) {
        $request->validate( [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ] );

        if ( Auth::guard( 'admin' )->attempt( $request->only( 'email', 'password' ) ) ) {
            return redirect()->route( 'admin.index' );
        }

        return back()->with( 'error', 'Invalid credentials' );
    }

    public function destroy() {
        Auth::guard( 'admin' )->logout();
        return redirect()->route( 'home' );
    }
}
