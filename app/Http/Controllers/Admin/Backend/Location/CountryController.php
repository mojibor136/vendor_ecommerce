<?php

namespace App\Http\Controllers\Admin\Backend\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Location\Country;

class CountryController extends Controller {
    public function index() {
        return view( 'admin.backend.location.country.index' );
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $country = Country::when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%$query%");
            })
            ->paginate(10);

        return response()->json($country);
    }

    public function create() {
        return view( 'admin.backend.location.country.create' );
    }

    public function store( Request $request ) {
        $request->validate(['country_name' => 'required|unique:countries,name']);

        Country::create([
            'name' => $request->country_name,
        ]);

        return redirect()->route('country.index');
    }

    public function edit($id) {
        $country = Country::findOrFail($id);
        return view( 'admin.backend.location.country.edit' , compact('country') );
    }

    public function update( Request $request ) {
        $request->validate(['country_name' => 'required']);

        $country = Country::findOrFail( $request->id );
        $country->update([
            'name' => $request->country_name,
        ]);

        return redirect()->route('country.index');
    }

    public function show() {
        return view( 'admin.backend.location.country.show' );
    }

    public function destroy( $id ) {
        Country::findOrFail( $id )->delete();
        return redirect()->route('country.index');
    }
}
