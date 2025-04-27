<?php

namespace App\Http\Controllers\Admin\BackEnd\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription\Subscription;

class SubscriptionController extends Controller {
    public function index() {
        return view( 'admin.backend.subscription.index' );
    }

    public function api(Request $request)
    {
        $query = $request->input('search');
        $status = $request->input('status');
    
        $subscriptions = Subscription::when($query, function ($q) use ($query) {
            return $q->where('name', 'LIKE', "%$query%");
        })
        ->when($status, function ($q) use ($status) {
            return $q->where('is_active', $status); 
        })
        ->latest()
        ->paginate(10);
    
        return response()->json($subscriptions);
    }
    
    public function create() {
        return view( 'admin.backend.subscription.create' );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'product_limit' => 'required|integer|min:0',
            'duration_days' => 'required|integer|min:1',
            'features' => 'required|string',
        ] );

        try {
            $featuresArray = $request->features
            ? array_map( 'trim', explode( ',', $request->features ) )
            : [];

            $subscription = new Subscription();
            $subscription->name = $validated[ 'name' ];
            $subscription->description = $validated[ 'description' ];
            $subscription->price = $validated[ 'price' ];
            $subscription->product_limit = $validated[ 'product_limit' ];
            $subscription->duration_days = $validated[ 'duration_days' ];
            $subscription->features = json_encode( $featuresArray );
            $subscription->save();

            return redirect()->route( 'subscription.index' )->with( 'success', 'Subscription created successfully.' );
        } catch ( \Exception $e ) {
            return back()->withInput()->with( 'error', 'Something went wrong: ' . $e->getMessage() );
        }
    }

    public function edit( $id ) {
        $subscription = Subscription::find( $id );
        return view( 'admin.backend.subscription.edit', compact( 'subscription' ) );
    }

    public function update( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'product_limit' => 'nullable|integer|min:1',
            'duration_days' => 'nullable|integer|min:1',
            'features' => 'nullable|string',
        ] );

        $subscription = Subscription::find( $request->id );

        if ( !$subscription ) {
            return redirect()->back()->with( 'error', 'Subscription not found.' );
        }

        $featuresArray = $request->features ? explode( ',', $request->features ) : [];

        $subscription->update( [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'product_limit' => $request->product_limit,
            'duration_days' => $request->duration_days,
            'features' => json_encode( $featuresArray ),
        ] );

        return redirect()->route( 'subscription.index' )->with( 'success', 'Subscription updated successfully.' );
    }

    public function show($id){
        $subscription = Subscription::findOrFail($id);
        return view('admin.backend.subscription.show' , compact('subscription'));
    }

    public function destroy( $id ) {
        Subscription::find( $id )->delete();
        return redirect()->back()->with( 'success', 'Subscription deleted successfully.' );
    }
}
