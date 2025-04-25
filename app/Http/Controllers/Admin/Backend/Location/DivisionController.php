<?php

namespace App\Http\Controllers\Admin\Backend\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Location\Division;
use App\Models\Backend\Location\Country;

class DivisionController extends Controller {
    public function index() {
        return view( 'admin.backend.location.division.index' );
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $division = Division::with('country')->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%$query%");
            })
            ->paginate(10);

        return response()->json($division);
    }

    public function getDivision($id){
        $division = Division::where('country_id', $id)->get();
        return response()->json($division);
    }

    public function create() {
        $countries = Country::all();
        return view( 'admin.backend.location.division.create' , compact('countries'));
    }

    public function store( Request $request ) {
        $request->validate([
            'country_id' => 'required',
            'division_name' => 'required|unique:divisions,name',
        ]);

        Division::create([
            'name' => $request->division_name,
            'country_id' => $request->country_id,
        ]);

        Country::findOrFail($request->country_id)->increment('division_count', 1);

        return redirect()->route('division.index');
    }

    public function edit($id) {
        $countries = Country::all();
        $division = Division::with('country')->findOrFail($id);
        return view( 'admin.backend.location.division.edit' , compact('division' , 'countries') );
    }

    public function update( Request $request ) {
        $request->validate([
            'country_id' => 'required',
            'division_name' => 'required',
        ]);
        
        $division = Division::findOrFail( $request->id );
        $oldCountry = $division->country_id;

        $division->update([
            'name' => $request->division_name,
            'country_id' => $request->country_id,
        ]);

        if ($oldCountry != $request->country_id) {
            Country::findOrFail($oldCountry)->decrement('division_count', 1);
            Country::findOrFail($request->country_id)->increment('division_count', 1);
        }

        return redirect()->route('division.index');
    }

    public function destroy( $id ) {
        $division = Division::findOrFail( $id );
        Country::findOrFail($division->country_id)->decrement('division_count', 1);
        $division->delete();
        return redirect()->route('division.index');
    }
}
