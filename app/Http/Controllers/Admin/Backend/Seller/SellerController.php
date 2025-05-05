<?php

namespace App\Http\Controllers\Admin\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller\Seller;
use App\Models\Subscription\Subscription;
use App\Models\Seller\SellerSubscription;

class SellerController extends Controller {
    public function index() {
        return view( 'admin.backend.seller.index' );
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $status = $request->input('status'); 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $sellers = Seller::with('products', 'activeSubscription')
        ->when($query, function ($q) use ($query) {
            return $q->where(function ($q2) use ($query) {
                $q2->where('name', 'LIKE', "%$query%")
                    ->orWhere('shop_name', 'LIKE', "%$query%");
            });
        })
        ->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })
        ->paginate(10);
        

        $sellers->each(function($seller) {
            $seller->subscription_status = $seller->subscription_status;
        });
            
        $sellers->getCollection()->transform(function ($seller) {
            $totalRating = 0;
            $ratingCount = 0;
    
            foreach ($seller->products as $product) {
                foreach ($product->approvedRatings as $rating) {
                    $totalRating += $rating->rating;
                    $ratingCount++;
                }
            }
    
            $seller->average_rating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : null;
            return $seller;
        });
    
        return response()->json($sellers);
    }

    public function activeApi(Request $request){
        $query = $request->input('search');
        $status = $request->input('status'); 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $sellers = Seller::with('products', 'activeSubscription')
        ->where('status', 'active')
        ->when($query, function ($q) use ($query) {
            return $q->where(function ($q2) use ($query) {
                $q2->where('name', 'LIKE', "%$query%")
                    ->orWhere('shop_name', 'LIKE', "%$query%");
            });
        })
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })
        ->paginate(10);
        

        $sellers->each(function($seller) {
            $seller->subscription_status = $seller->subscription_status;
        });
            
        $sellers->getCollection()->transform(function ($seller) {
            $totalRating = 0;
            $ratingCount = 0;
    
            foreach ($seller->products as $product) {
                foreach ($product->approvedRatings as $rating) {
                    $totalRating += $rating->rating;
                    $ratingCount++;
                }
            }
    
            $seller->average_rating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : null;
            return $seller;
        });
    
        return response()->json($sellers);
    }

    public function inactiveApi(Request $request){
        $query = $request->input('search');
        $status = $request->input('status'); 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $sellers = Seller::with('products', 'activeSubscription')
        ->where('status', 'inactive')
        ->when($query, function ($q) use ($query) {
            return $q->where(function ($q2) use ($query) {
                $q2->where('name', 'LIKE', "%$query%")
                    ->orWhere('shop_name', 'LIKE', "%$query%");
            });
        })
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })
        ->paginate(10);
        

        $sellers->each(function($seller) {
            $seller->subscription_status = $seller->subscription_status;
        });
            
        $sellers->getCollection()->transform(function ($seller) {
            $totalRating = 0;
            $ratingCount = 0;
    
            foreach ($seller->products as $product) {
                foreach ($product->approvedRatings as $rating) {
                    $totalRating += $rating->rating;
                    $ratingCount++;
                }
            }
    
            $seller->average_rating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : null;
            return $seller;
        });
    
        return response()->json($sellers);
    }

    public function show($id)
    {
        $seller = Seller::with([
            'country',
            'division',
            'district',
            'activeSubscription.subscription',
            'products.approvedRatings'
        ])->findOrFail($id);
    
        $totalRating = 0;
        $totalReviews = 0;
    
        foreach ($seller->products as $product) {
            foreach ($product->approvedRatings as $rating) {
                $totalRating += $rating->rating;
                $totalReviews++;
            }
        }
    
        $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : null;
    
        return view('admin.backend.seller.show', compact("seller", "averageRating"));
    }
    

    
    public function destroy($id){
        Seller::find($id)->delete();
        return redirect()->back();
    }
    
    public function status(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $seller->status = $request->status;
        $seller->save();
    
        return response()->json(['success' => true]);
    }

    public function inactive(){
        return view('admin.backend.seller.inactive');
    }

    public function active(){
        return view('admin.backend.seller.active');
    }
}
