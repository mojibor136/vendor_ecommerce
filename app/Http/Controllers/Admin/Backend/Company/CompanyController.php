<?php

namespace App\Http\Controllers\Admin\Backend\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller {
    public function index() {
        $companies = Company::all();
        return view( 'admin.backend.company.index', compact( 'companies' ) );
    }

    public function store( Request $request ) {
        try {
            $validated = $request->validate( [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:companies,email',
                'address' => 'required|string|max:255',
                'fax' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'company' => 'nullable|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ] );

            if ( Company::exists() ) {
                return redirect()->back()->with( 'error', 'You already have a company added!' );
            }

            $logoName = null;
            if ( $request->hasFile( 'logo' ) ) {
                $logoName = $request->file( 'logo' )->store( 'logo', 'public' );
            }

            $iconName = null;
            if ( $request->hasFile( 'icon' ) ) {
                $iconName = $request->file( 'icon' )->store( 'icon', 'public' );
            }

            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->fax = $request->fax;
            $company->phone = $request->phone;
            $company->company = $request->company;
            $company->logo = $logoName;
            $company->icon = $iconName;
            $company->save();

            return redirect()->route( 'company.index' )->with( 'success', 'Company created successfully!' );
        } catch ( \Exception $e ) {
            return back()->withInput()->with( 'error', 'Something went wrong: ' . $e->getMessage() );
        }
    }

    public function show( $id ) {
        $company = Company::findOrFail( $id );
        return view( 'admin.backend.company.show', compact( 'company' ) );
    }

    public function create() {
        return view( 'admin.backend.company.create' );
    }

    public function update( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'fax' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ] );

        $company = Company::findOrFail( $request->input( 'id' ) );

        if ( $request->hasFile( 'logo' ) ) {
            if ( $company->logo ) {
                Storage::delete( $company->logo );
            }
            $logoPath = $request->file( 'logo' )->store( 'logo', 'public' );
        } else {
            $logoPath = $company->logo;
        }

        if ( $request->hasFile( 'icon' ) ) {
            if ( $company->icon ) {
                Storage::delete( $company->icon );
            }
            $iconPath = $request->file( 'icon' )->store( 'icon', 'public' );
        } else {
            $iconPath = $company->icon;
        }

        $company->update( [
            'name' => $validatedData[ 'name' ],
            'email' => $validatedData[ 'email' ],
            'address' => $validatedData[ 'address' ],
            'fax' => $validatedData[ 'fax' ],
            'phone' => $validatedData[ 'phone' ],
            'company' => $validatedData[ 'company' ],
            'logo' => $logoPath,
            'icon' => $iconPath,
        ] );

        return redirect()->route( 'company.index' )->with( 'success', 'Company updated successfully!' );
    }

    public function edit( $id ) {
        $company = Company::findOrFail( $id );
        return view( 'admin.backend.company.edit', compact( 'company' ) );
    }

    public function destroy( $id ) {
        Company::findOrFail( $id )->delete();
        return redirect()->route( 'company.index' )->with( 'success', 'Company deleted successfully!' );
    }
}
