<?php

namespace App\Http\Controllers\Admin\Backend\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Location\District;
use App\Models\Backend\Location\Division;

class DistrictController extends Controller {
    public function index() {
        return view( 'admin.backend.location.district.index' );
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $district = District::with('division')->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%$query%");
            })
            ->paginate(10);

        return response()->json($district);
    }

    public function getDistrict($id){
        $district = District::where('division_id', $id)->get();
        return response()->json($district);
    }

    public function create() {
        $divisions = Division::all();
        return view( 'admin.backend.location.district.create' , compact('divisions') );
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required|unique:districts,name',
        ]);
    
        District::create([
            'name' => $request->district_name,
            'division_id' => $request->division_id,
        ]);

        Division::findOrFail($request->division_id)->increment('district_count', 1);
    
        return redirect()->route('district.index');
    }
    

    public function edit($id) {
        $divisions = Division::all();
        $district = District::with('division')->findOrFail($id);
        return view( 'admin.backend.location.district.edit' , compact('district' , 'divisions'));
    }

    public function update( Request $request ) {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        $district = District::findOrFail( $request->id );
        $oldDivision = $district->division_id;

        $district->update([
            'name' => $request->district_name,
            'division_id' => $request->division_id,
        ]);

        if ($oldDivision != $request->division_id) {
            Division::findOrFail($oldDivision)->decrement('district_count', 1);
            Division::findOrFail($request->division_id)->increment('district_count', 1);
        }

        return redirect()->route('district.index');
    }

    public function destroy( $id ) {
        $district = District::findOrFail( $id );
        Division::findOrFail($district->division_id)->decrement('district_count', 1);
        $district->delete();
        return redirect()->route('district.index');
    }
}
