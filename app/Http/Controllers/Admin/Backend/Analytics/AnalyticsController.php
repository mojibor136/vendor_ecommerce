<?php

namespace App\Http\Controllers\Admin\Backend\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller\Seller;
use App\Models\Backend\ProductRating;
use App\Models\Order\Order;
use App\Models\Order\Shipping;
use App\Models\Backend\Location\District;
use App\Models\Backend\Location\Country;
use App\Models\Backend\Location\Division;
use Illuminate\Support\Facades\Log;

class AnalyticsController extends Controller {

    // The index method where the sellers' data is fetched

    public function index() {
        return view('admin.backend.analytics.seller-order.index');
    }
    
    public function getSellersData(Request $request){
        $search = $request->input('search');
    
        $sellers = Seller::select('id', 'name', 'shop_name')
        ->withCount([
            'orders as delivered_orders_count' => function ($q) {
                $q->where('order_status', 'delivered')
                  ->where('role', 'seller');
            },
            'orders as pending_orders_count' => function ($q) {
                $q->where('order_status', 'pending')
                  ->where('role', 'seller');
            },
            'orders as canceled_orders_count' => function ($q) {
                $q->where('order_status', 'canceled')
                  ->where('role', 'seller');
            },
        ])
        ->with(['products.approvedRatings'])
        ->when($search, function($q) use ($search) {
            $q->where('shop_name', 'LIKE', "%{$search}%");
        })
        ->paginate(10);      
    
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

    public function showSellerOrders($shop_name , $sellerId) {
        $seller = Seller::findOrFail($sellerId);

        $orders = Order::with(['orderItems.product', 'orderItems.product.approvedRatings', 'shipping'])
        ->where('author_id', $sellerId)
        ->orderByDesc('id')
        ->paginate(10);

        return view('admin.backend.analytics.seller-order.show', compact('seller', 'orders'));
    }
    
    public function salesLocation(){
        $countries = Country::all();
        return view('admin.backend.analytics.sales-location.index', compact('countries'));
    }
    
    public function getSalesLocation(Request $request){
        $countryId = $request->country_id;
        $divisionId = $request->division_id;
    
        $divisionCoords = [
            'Dhaka' => ['lat' => 23.7643863, 'lng' => 90.3890144],
            'Chattogram' => ['lat' => 22.333778, 'lng' => 91.8344348],
            'Khulna' => ['lat' => 22.9372087, 'lng' => 89.2852741],
            'Barisal' => ['lat' => 22.4934035, 'lng' => 90.3548015],
            'Rajshahi' => ['lat' => 24.6285432, 'lng' => 89.0376862],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
        ];

        $districtCoords = [
            'Dhaka' => ['lat' => 23.7643863, 'lng' => 90.3890144],
            'Chattogram' => ['lat' => 22.333778, 'lng' => 91.8344348],
            'Khulna' => ['lat' => 22.9372087, 'lng' => 89.2852741],
            'Barisal' => ['lat' => 22.4934035, 'lng' => 90.3548015],
            'Rajshahi' => ['lat' => 24.6285432, 'lng' => 89.0376862],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
            'Bagerhat' => ['lat' => 22.7038, 'lng' => 89.8000],
            'Bandarban' => ['lat' => 22.2199, 'lng' => 92.1927],
            'Barisal' => ['lat' => 22.7010, 'lng' => 90.3535],
            'Bhola' => ['lat' => 22.6812, 'lng' => 90.6488],
            'Bogra' => ['lat' => 24.8454, 'lng' => 89.3487],
            'Chandpur' => ['lat' => 23.2232, 'lng' => 90.8323],
            'Chuadanga' => ['lat' => 23.9577, 'lng' => 88.6794],
            'Comilla' => ['lat' => 23.4620, 'lng' => 91.1834],
            'Cox\'s Bazar' => ['lat' => 21.4513, 'lng' => 92.0043],
            'Dhaka' => ['lat' => 23.8103, 'lng' => 90.4125],
            'Dinajpur' => ['lat' => 25.4667, 'lng' => 88.6250],
            'Faridpur' => ['lat' => 23.6061, 'lng' => 89.8506],
            'Feni' => ['lat' => 23.0150, 'lng' => 91.3981],
            'Gaibandha' => ['lat' => 25.3172, 'lng' => 89.5407],
            'Gazipur' => ['lat' => 23.8762, 'lng' => 90.3969],
            'Gopalganj' => ['lat' => 23.2284, 'lng' => 89.8274],
            'Habiganj' => ['lat' => 24.3202, 'lng' => 91.4390],
            'Jamuna' => ['lat' => 23.4764, 'lng' => 90.0578],
            'Jhenaidah' => ['lat' => 23.5157, 'lng' => 89.1186],
            'Khulna' => ['lat' => 22.8456, 'lng' => 89.5403],
            'Kishoreganj' => ['lat' => 24.4414, 'lng' => 90.7117],
            'Kurigram' => ['lat' => 25.6793, 'lng' => 89.0935],
            'Kushtia' => ['lat' => 23.9055, 'lng' => 89.1220],
            'Lakshmipur' => ['lat' => 23.1355, 'lng' => 91.1577],
            'Lalmonirhat' => ['lat' => 25.9163507, 'lng' => 89.4461394],
            'Madarihat' => ['lat' => 23.3806, 'lng' => 88.5370],
            'Magura' => ['lat' => 23.8264, 'lng' => 89.2905],
            'Manikganj' => ['lat' => 23.8415, 'lng' => 90.1761],
            'Moulvibazar' => ['lat' => 24.4915, 'lng' => 91.7475],
            'Munshiganj' => ['lat' => 23.8401, 'lng' => 90.5395],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
            'Naogaon' => ['lat' => 24.7721, 'lng' => 88.9196],
            'Narayanganj' => ['lat' => 23.6628, 'lng' => 90.5057],
            'Narsingdi' => ['lat' => 23.9192, 'lng' => 90.7187],
            'Netrokona' => ['lat' => 24.8837, 'lng' => 90.7251],
            'Nilphamari' => ['lat' => 25.9455, 'lng' => 88.7273],
            'Pabna' => ['lat' => 23.6369, 'lng' => 89.2243],
            'Panchagarh' => ['lat' => 26.3392, 'lng' => 88.6363],
            'Patuakhali' => ['lat' => 22.3545, 'lng' => 90.3273],
            'Rajbari' => ['lat' => 23.7571, 'lng' => 89.3505],
            'Rangamati' => ['lat' => 23.1369, 'lng' => 92.1497],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Satkhira' => ['lat' => 22.6947, 'lng' => 89.0757],
            'Shariatpur' => ['lat' => 23.6507, 'lng' => 90.0286],
            'Sherpur' => ['lat' => 24.8773, 'lng' => 90.0179],
            'Sirajganj' => ['lat' => 24.4673, 'lng' => 89.7100],
            'Sunamganj' => ['lat' => 24.9063, 'lng' => 91.3800],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Tangail' => ['lat' => 24.2529, 'lng' => 89.9559],
            'Thakurgaon' => ['lat' => 25.6403, 'lng' => 88.4791],
            'Habiganj' => ['lat' => 24.3202, 'lng' => 91.4390],
            'Chandpur' => ['lat' => 23.2232, 'lng' => 90.8323],
            'Kurigram' => ['lat' => 25.6793, 'lng' => 89.0935],
            'Noakhali' => ['lat' => 22.9579, 'lng' => 91.0791],
        ];  
    
        // When a division is selected
        if ($divisionId) {
            $districts = District::where('division_id', $divisionId)->get();
    
            $salesByDistrict = Shipping::selectRaw('shipping_district_id, COUNT(*) as total_sales')
                ->where('shipping_division_id', $divisionId)
                ->groupBy('shipping_district_id')
                ->pluck('total_sales', 'shipping_district_id');
    
            $Data = [];
            foreach ($districts as $district) {
                $coords = $districtCoords[$district->name] ?? ['lat' => null, 'lng' => null];
                $Data[] = [
                    'name' => $district->name,
                    'sales' => $salesByDistrict[$district->id] ?? 0,
                    'lat' => $coords['lat'],
                    'lng' => $coords['lng'],
                ];
            }
    
            return response()->json(['Data' => $Data]);
        }
      
    
        if ($countryId) {
            $divisions = Division::where('country_id', $countryId)->get();
    
            $salesByDivision = Shipping::selectRaw('shipping_division_id, COUNT(*) as total_sales')
                ->where('shipping_country_id', $countryId)
                ->groupBy('shipping_division_id')
                ->pluck('total_sales', 'shipping_division_id');
    
            $Data = [];
            foreach ($divisions as $division) {
                $salesCount = $salesByDivision[$division->id] ?? 0;
    
                $coords = $divisionCoords[$division->name] ?? ['lat' => null, 'lng' => null];
    
                $Data[] = [
                    'name' => $division->name,
                    'sales' => $salesCount,
                    'lat' => $coords['lat'],
                    'lng' => $coords['lng'],
                ];
            }
    
            return response()->json([
                'divisions' => $divisions,
                'Data' => $Data
            ]);
        }
    
        return response()->json(['Data' => []]);
    }

    public function sellerLocation(){
        $countries = Country::all();
        return view('admin.backend.analytics.seller-location.index', compact('countries'));
    }

    public function getSellerLocation(Request $request){
        $countryId = $request->country_id;
        $divisionId = $request->division_id;
    
        $divisionCoords = [
            'Dhaka' => ['lat' => 23.7643863, 'lng' => 90.3890144],
            'Chattogram' => ['lat' => 22.333778, 'lng' => 91.8344348],
            'Khulna' => ['lat' => 22.9372087, 'lng' => 89.2852741],
            'Barisal' => ['lat' => 22.4934035, 'lng' => 90.3548015],
            'Rajshahi' => ['lat' => 24.6285432, 'lng' => 89.0376862],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
        ];

        $districtCoords = [
            'Dhaka' => ['lat' => 23.7643863, 'lng' => 90.3890144],
            'Chattogram' => ['lat' => 22.333778, 'lng' => 91.8344348],
            'Khulna' => ['lat' => 22.9372087, 'lng' => 89.2852741],
            'Barisal' => ['lat' => 22.4934035, 'lng' => 90.3548015],
            'Rajshahi' => ['lat' => 24.6285432, 'lng' => 89.0376862],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
            'Bagerhat' => ['lat' => 22.7038, 'lng' => 89.8000],
            'Bandarban' => ['lat' => 22.2199, 'lng' => 92.1927],
            'Barisal' => ['lat' => 22.7010, 'lng' => 90.3535],
            'Bhola' => ['lat' => 22.6812, 'lng' => 90.6488],
            'Bogra' => ['lat' => 24.8454, 'lng' => 89.3487],
            'Chandpur' => ['lat' => 23.2232, 'lng' => 90.8323],
            'Chuadanga' => ['lat' => 23.9577, 'lng' => 88.6794],
            'Comilla' => ['lat' => 23.4620, 'lng' => 91.1834],
            'Cox\'s Bazar' => ['lat' => 21.4513, 'lng' => 92.0043],
            'Dhaka' => ['lat' => 23.8103, 'lng' => 90.4125],
            'Dinajpur' => ['lat' => 25.4667, 'lng' => 88.6250],
            'Faridpur' => ['lat' => 23.6061, 'lng' => 89.8506],
            'Feni' => ['lat' => 23.0150, 'lng' => 91.3981],
            'Gaibandha' => ['lat' => 25.3172, 'lng' => 89.5407],
            'Gazipur' => ['lat' => 23.8762, 'lng' => 90.3969],
            'Gopalganj' => ['lat' => 23.2284, 'lng' => 89.8274],
            'Habiganj' => ['lat' => 24.3202, 'lng' => 91.4390],
            'Jamuna' => ['lat' => 23.4764, 'lng' => 90.0578],
            'Jhenaidah' => ['lat' => 23.5157, 'lng' => 89.1186],
            'Khulna' => ['lat' => 22.8456, 'lng' => 89.5403],
            'Kishoreganj' => ['lat' => 24.4414, 'lng' => 90.7117],
            'Kurigram' => ['lat' => 25.6793, 'lng' => 89.0935],
            'Kushtia' => ['lat' => 23.9055, 'lng' => 89.1220],
            'Lakshmipur' => ['lat' => 23.1355, 'lng' => 91.1577],
            'Lalmonirhat' => ['lat' => 25.9163507, 'lng' => 89.4461394],
            'Madarihat' => ['lat' => 23.3806, 'lng' => 88.5370],
            'Magura' => ['lat' => 23.8264, 'lng' => 89.2905],
            'Manikganj' => ['lat' => 23.8415, 'lng' => 90.1761],
            'Moulvibazar' => ['lat' => 24.4915, 'lng' => 91.7475],
            'Munshiganj' => ['lat' => 23.8401, 'lng' => 90.5395],
            'Mymensingh' => ['lat' => 24.7471, 'lng' => 90.4203],
            'Naogaon' => ['lat' => 24.7721, 'lng' => 88.9196],
            'Narayanganj' => ['lat' => 23.6628, 'lng' => 90.5057],
            'Narsingdi' => ['lat' => 23.9192, 'lng' => 90.7187],
            'Netrokona' => ['lat' => 24.8837, 'lng' => 90.7251],
            'Nilphamari' => ['lat' => 25.9455, 'lng' => 88.7273],
            'Pabna' => ['lat' => 23.6369, 'lng' => 89.2243],
            'Panchagarh' => ['lat' => 26.3392, 'lng' => 88.6363],
            'Patuakhali' => ['lat' => 22.3545, 'lng' => 90.3273],
            'Rajbari' => ['lat' => 23.7571, 'lng' => 89.3505],
            'Rangamati' => ['lat' => 23.1369, 'lng' => 92.1497],
            'Rangpur' => ['lat' => 25.7439, 'lng' => 89.2752],
            'Satkhira' => ['lat' => 22.6947, 'lng' => 89.0757],
            'Shariatpur' => ['lat' => 23.6507, 'lng' => 90.0286],
            'Sherpur' => ['lat' => 24.8773, 'lng' => 90.0179],
            'Sirajganj' => ['lat' => 24.4673, 'lng' => 89.7100],
            'Sunamganj' => ['lat' => 24.9063, 'lng' => 91.3800],
            'Sylhet' => ['lat' => 24.8949, 'lng' => 91.8687],
            'Tangail' => ['lat' => 24.2529, 'lng' => 89.9559],
            'Thakurgaon' => ['lat' => 25.6403, 'lng' => 88.4791],
            'Habiganj' => ['lat' => 24.3202, 'lng' => 91.4390],
            'Chandpur' => ['lat' => 23.2232, 'lng' => 90.8323],
            'Kurigram' => ['lat' => 25.6793, 'lng' => 89.0935],
            'Noakhali' => ['lat' => 22.9579, 'lng' => 91.0791],
        ];  
    
        // When a division is selected
        if ($divisionId) {
            $districts = District::where('division_id', $divisionId)->get();
    
            $salesByDistrict = Seller::selectRaw('district_id, COUNT(*) as total_seller')
                ->where('division_id', $divisionId)
                ->groupBy('district_id')
                ->pluck('total_seller', 'district_id');
    
            $Data = [];
            foreach ($districts as $district) {
                $coords = $districtCoords[$district->name] ?? ['lat' => null, 'lng' => null];
                $Data[] = [
                    'name' => $district->name,
                    'sales' => $salesByDistrict[$district->id] ?? 0,
                    'lat' => $coords['lat'],
                    'lng' => $coords['lng'],
                ];
            }
    
            return response()->json(['Data' => $Data]);
        }
      
    
        if ($countryId) {
            $divisions = Division::where('country_id', $countryId)->get();
    
            $salesByDivision = Seller::selectRaw('division_id, COUNT(*) as total_seller')
                ->where('country_id', $countryId)
                ->groupBy('division_id')
                ->pluck('total_seller', 'division_id');
    
            $Data = [];
            foreach ($divisions as $division) {
                $salesCount = $salesByDivision[$division->id] ?? 0;
    
                $coords = $divisionCoords[$division->name] ?? ['lat' => null, 'lng' => null];
    
                $Data[] = [
                    'name' => $division->name,
                    'sales' => $salesCount,
                    'lat' => $coords['lat'],
                    'lng' => $coords['lng'],
                ];
            }
    
            return response()->json([
                'divisions' => $divisions,
                'Data' => $Data
            ]);
        }
    
        return response()->json(['Data' => []]);
    }

}
