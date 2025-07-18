<?php
use Illuminate\Support\Facades\Route;
// Seller Back-End Routes
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\Backend\Category\CategoryController as SellerCategoryController;
use App\Http\Controllers\Seller\Backend\SubCategory\SubCategoryController as SellerSubCategoryController;
use App\Http\Controllers\Seller\Backend\Product\ProductController as SellerProductController;
use App\Http\Controllers\Seller\Backend\Order\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\Backend\Analytics\AnalyticsController as SellerAnalyticsController;
// Admin Back-End Routes
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Backend\Category\CategoryController;
use App\Http\Controllers\Admin\Backend\SubCategory\SubCategoryController;
use App\Http\Controllers\Admin\Backend\Product\ProductController;
use App\Http\Controllers\Admin\Backend\User\UserController;
use App\Http\Controllers\Admin\BackEnd\Subscription\SubscriptionController;
use App\Http\Controllers\Admin\BackEnd\Order\OrderController;
use App\Http\Controllers\Admin\Backend\Seller\SellerController as BackendSellerController;
use App\Http\Controllers\Admin\Backend\Location\DivisionController;
use App\Http\Controllers\Admin\Backend\Location\DistrictController;
use App\Http\Controllers\Admin\Backend\Location\CountryController;
use App\Http\Controllers\Admin\Backend\Analytics\AnalyticsController;
use App\Http\Controllers\Admin\Backend\Payment\SellerPaymentController;
use App\Http\Controllers\Admin\Backend\Payment\OrderPaymentController;
use App\Http\Controllers\Admin\Backend\Payment\SubscriptionPaymentController;
use App\Http\Controllers\Admin\Backend\Api\ApiController;
use App\Http\Controllers\Admin\Backend\Slider\SliderController;
// Front-End Routes
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\SearchController;
// CourierController Routes
use App\Http\Controllers\Courier\CourierController;

// 🔐 Auth Routes (Laravel Breeze / Fortify ইত্যাদি ইউজ করলে এখানে থাকে)
require __DIR__.'/auth.php';

// 🛡️ Admin Routes Group (Only accessible if admin is authenticated)
Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.index');
});

Route::get('admin/sales/weekly', [AdminController::class, 'getOneWeeklySalesData']);
Route::get('admin/sales/monthly', [AdminController::class, 'getMonthlySalesData']);
Route::get('admin/sales/yearly', [AdminController::class, 'getYearlySalesData']);

Route::prefix('admin')->middleware('admin')->group(function(){
    // 🔹 CategoryController CRUD Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories/api' , 'api')->name('categories.api');
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories', 'store')->name('categories.store');
        Route::get('/categories/edit/{id}' , 'edit')->name('categories.edit');
        Route::get('/categories/show/{id}', 'show')->name('categories.show');
        Route::post('/categories/update', 'update')->name('categories.update');
        Route::get('/categories/destroy/{id}', 'destroy')->name('categories.destroy');
    });
    
    // 🔹 SubCategoryController CRUD Routes
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/get/subcategories/{id}' , 'getSubCategories')->name('get.subcategories');
        Route::get('/subcategories/api' , 'api')->name('subcategories.api');
        Route::get('/subcategories', 'index')->name('subcategories.index');
        Route::get('/subcategories/create', 'create')->name('subcategories.create');
        Route::post('/subcategories/store', 'store')->name('subcategories.store');
        Route::get('/subcategories/edit/{id}' , 'edit')->name('subcategories.edit');
        Route::get('/subcategories/show/{id}', 'show')->name('subcategories.show');
        Route::post('/subcategories/update', 'update')->name('subcategories.update');
        Route::get('/subcategories/destroy/{id}', 'destroy')->name('subcategories.destroy');
    });  
    
    // 🔹 ProductController CRUD Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/api' , 'api')->name('products.api');
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/status/{id}' , 'status')->name('products.status');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products/store', 'store')->name('products.store');
        Route::get('/products/edit/{id}' , 'edit')->name('products.edit');
        Route::get('/products/show/{id}', 'show')->name('products.show');
        Route::post('/products/update', 'update')->name('products.update');
        Route::get('product/add/stock' , 'addStock')->name('product.add.stock');
        Route::post('product/update/stock' , 'updateStock')->name('product.update.stock');
        Route::get('/products/destroy/{id}', 'destroy')->name('products.destroy');
    });

    // 🔹 SubscriptionController CRUD Routes
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/subscription/api' , 'api')->name('subscription.api');
        Route::get('/yearly/subscription/api' , 'yearlyApi')->name('subscription.yearly.api');
        Route::get('/monthly/subscription/api' , 'monthlyApi')->name('subscription.monthly.api');
        Route::get('/subscription', 'index')->name('subscription.index');
        Route::get('/monthly/subscription', 'monthly')->name('subscription.monthly');
        Route::get('/yearly/subscription', 'yearly')->name('subscription.yearly');
        Route::get('/subscription/create', 'create')->name('subscription.create');
        Route::post('/subscription/store', 'store')->name('subscription.store');
        Route::get('/subscription/edit/{id}' , 'edit')->name('subscription.edit');
        Route::post('/subscription/update', 'update')->name('subscription.update');
        Route::get('/subscription/show/{id}', 'show')->name('subscription.show');
        Route::get('/subscription/destroy/{id}', 'destroy')->name('subscription.destroy');
    });

    // 🔹 OrderController CRUD Routes
     Route::controller(OrderController::class)->group(function () {
        Route::get('/order/api', 'api')->name('order.api');
        Route::get('/order/delivered/api', 'deliveredApi')->name('delivered.order.api');
        Route::get('/order/cancelled/api', 'cancelledApi')->name('cancelled.order.api');
        Route::get('/order/shipped/api', 'shippedApi')->name('shipped.order.api');
        Route::get('/order/processing/api', 'processingApi')->name('processing.order.api');                
        Route::get('/order', 'index')->name('order.index');
        Route::get('/cancel/order', 'cancel')->name('cancel.order');
        Route::get('/processing/order', 'processing')->name('processing.order');
        Route::get('/shipping/order', 'shipping')->name('shipping.order');
        Route::get('/delivered/order', 'delivered')->name('delivered.order');
        Route::post('/order/status' , 'status')->name('order.status');
        Route::post('/shipped/manual' , 'manual')->name('shipped.manual');
        Route::post('/shipped/auto' , 'auto')->name('shipped.auto');
        Route::get('/order/show/{shop_name}/{shop_id}', 'show')->name('order.show');
        Route::get('/order/destroy/{id}', 'destroy')->name('order.destroy');
    });

    // 🔹 ApiController CRUD Routes
    Route::controller(ApiController::class)->group(function () {
        Route::get('/payment-integration', 'paymentIntegration')->name('payment.integration');
        Route::get('/courier-integration', 'courierIntegration')->name('courier.integration');
        Route::get('/pixel-integration', 'pixelIntegration')->name('pixel.integration');
        Route::get('/gtag-integration', 'gtagIntegration')->name('gtag.integration');
        Route::get('/sms-integration', 'smsIntegration')->name('sms.integration');
        Route::get('/email-integration', 'emailIntegration')->name('email.integration');
    });

    // 🔹 SellerPaymentController CRUD Routes
    Route::controller(SellerPaymentController::class)->group(function () {
        Route::get('/seller/payment' , 'index')->name('seller.payment.index');
        Route::get('/seller/payment/api' , 'api')->name('seller.payment.api');
        Route::get('/seller/payment/show/{id}' , 'show')->name('seller.payment.show');
        Route::post('seller/payment/status' , 'status')->name('seller.payment.status');
    });

    // 🔹 OrderPaymentController CRUD Routes
    Route::controller(OrderPaymentController::class)->group(function () {
        Route::get('/order/payment' , 'index')->name('order.payment.index');
        Route::get('/order/payment/api' , 'api')->name('order.payment.api');
    });

    // 🔹 SubscriptionPaymentController CRUD Routes
    Route::controller(SubscriptionPaymentController::class)->group(function () {
        Route::get('/subscription/payment' , 'index')->name('subscription.payment.index');
        Route::get('/subscription/payment/api' , 'api')->name('subscription.payment.api');
    });

    // 🔹 UserController CRUD Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/api' , 'api')->name('user.api');
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/status/{id}' , 'status')->name('user.status');
        Route::get('/user/show/{id}', 'show')->name('user.show');
        Route::get('/user/destroy/{id}', 'destroy')->name('user.destroy');
    });

    // 🔹 BackendSellerController CRUD Routes
    Route::controller(BackendSellerController::class)->group(function () {
        Route::get('/seller/api' , 'api')->name('seller.api');
        Route::get('/inactive/seller/api' , 'inactiveApi')->name('inactive.seller.api');
        Route::get('/active/seller/api' , 'activeApi')->name('active.seller.api');
        Route::get('/seller', 'index')->name('seller.index');
        Route::get('/active/seller', 'active')->name('active.seller');
        Route::get('/inactive/seller', 'inactive')->name('inactive.seller');
        Route::post('/seller/verification/{id}/status' , 'status')->name('seller.verification.status');
        Route::get('/seller/show/{id}', 'show')->name('seller.show');
        Route::get('/seller/destroy/{id}', 'destroy')->name('seller.destroy');
    });

    // 🔹 DivisionController CRUD Routes
    Route::controller(DivisionController::class)->group(function () {
        Route::get('/get/division/{id}' , 'getDivision')->name('get.division');
        Route::get('/division/api' , 'api')->name('division.api');
        Route::get('/division', 'index')->name('division.index');
        Route::get('/division/create', 'create')->name('division.create');
        Route::post('/division/store', 'store')->name('division.store');
        Route::get('/division/edit/{id}' , 'edit')->name('division.edit');
        Route::post('/division/update', 'update')->name('division.update');
        Route::get('/division/show/{id}', 'show')->name('division.show');
        Route::get('/division/destroy/{id}', 'destroy')->name('division.destroy');
    });
    
    // 🔹 DistrictController CRUD Routes
    Route::controller(DistrictController::class)->group(function () {
        Route::get('/get/district/{id}' , 'getDistrict')->name('get.district');
        Route::get('/district/api' , 'api')->name('district.api');
        Route::get('/district', 'index')->name('district.index');
        Route::get('/district/create', 'create')->name('district.create');
        Route::post('/district/store', 'store')->name('district.store');
        Route::get('/district/edit/{id}' , 'edit')->name('district.edit');
        Route::post('/district/update', 'update')->name('district.update');
        Route::get('/district/show/{id}', 'show')->name('district.show');
        Route::get('/district/destroy/{id}', 'destroy')->name('district.destroy');
    });

    // 🔹 CountryController CRUD Routes
    Route::controller(CountryController::class)->group(function () {
        Route::get('/country/api' , 'api')->name('country.api');
        Route::get('/country', 'index')->name('country.index');
        Route::get('/country/create', 'create')->name('country.create');
        Route::post('/country/store', 'store')->name('country.store');
        Route::get('/country/edit/{id}' , 'edit')->name('country.edit');
        Route::post('/country/update', 'update')->name('country.update');
        Route::get('/country/show/{id}', 'show')->name('country.show');
        Route::get('/country/destroy/{id}', 'destroy')->name('country.destroy');
    });

    // 🔹 AnalyticsController CRUD Routes
    Route::controller(AnalyticsController::class)->group(function () {
        Route::get('/sales/report', 'index')->name('sales.report');
        Route::get('/seller-location' , 'sellerLocation')->name('seller.location');
        Route::get('/get-seller-location' , 'getSellerLocation')->name('get.seller.location');
        Route::get('/sales-location' , 'salesLocation')->name('sales.location');
        Route::get('/get-sales-location' , 'getSalesLocation')->name('get.sales.location');
        Route::get('/sales/report/data' , 'getSellersData')->name('sales.report.data');
        Route::get('/seller/orders/{shop_name}/{shop_id}', 'showSellerOrders')->name('seller.orders');
    });
    
    // 🔹 SliderController CRUD Routes
    Route::controller(SliderController::class)->prefix('slider')->group(function () {
        // Main Slider Routes
        Route::get('/main', 'mainSliderIndex')->name('slider.main.index');
        Route::get('/main/create', 'mainSliderCreate')->name('slider.main.create');
        Route::post('/main/store', 'mainSliderStore')->name('slider.main.store');
        Route::get('/main/image-delete/{slider}', 'deleteMainImage')->name('slider.main.image.delete');
        // Sub Slider Routes
        Route::get('/sub', 'subSliderIndex')->name('slider.sub.index');
        Route::get('/sub/create', 'subSliderCreate')->name('slider.sub.create');
        Route::post('/sub/store', 'subSliderStore')->name('slider.sub.store');
        Route::get('/sub/image-delete/{slider}', 'deleteSubImage')->name('slider.sub.image.delete');
    });
});

// 🛡️ Seller Routes Group (Only accessible if seller is authenticated)
Route::controller(CourierController::class)->group(function () {
    Route::post('/courier-check', 'check')->name('courier.check');
});

// 🛡️ Seller Routes Group (Only accessible if seller is authenticated)
Route::prefix('seller')->middleware('seller')->controller(SellerController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('seller.dashboard');
    Route::get('/edit/{id}', 'edit')->name('seller.edit');
    Route::post('/update/{id}', 'update')->name('seller.update');
    Route::get('/destroy/{id}', 'destroy')->name('seller.destroy');
});

Route::prefix('seller')->middleware('seller')->group(function(){
    // 🔹 SellerOrderController CRUD Routes
     Route::controller(SellerOrderController::class)->group(function () {
        Route::get('/order/api' , 'api')->name('seller.order.api');
        Route::get('/order', 'index')->name('seller.order.index');
        Route::get('/order/status/{id}' , 'status')->name('seller.order.status');
        Route::get('/order/show/{id}', 'show')->name('seller.order.show');
    });

    // 🔹 SellerCategoryController CRUD Routes
    Route::controller(SellerCategoryController::class)->group(function () {
        Route::get('/categories/api' , 'api')->name('seller.categories.api');
        Route::get('/categories', 'index')->name('seller.categories.index');
        Route::get('/categories/show/{id}', 'show')->name('seller.categories.show');
    });
    
    // 🔹 SellerSubCategoryController CRUD Routes
    Route::controller(SellerSubCategoryController::class)->group(function () {
        Route::get('/get/subcategories/{id}' , 'getSubCategories')->name('seller.get.subcategories');
        Route::get('/subcategories/api' , 'api')->name('seller.subcategories.api');
        Route::get('/subcategories', 'index')->name('seller.subcategories.index');
        Route::get('/subcategories/show/{id}', 'show')->name('seller.subcategories.show');
    });  
    
    // 🔹 SellerProductController CRUD Routes
    Route::controller(SellerProductController::class)->group(function () {
        Route::get('/products/api' , 'api')->name('seller.products.api');
        Route::get('/products', 'index')->name('seller.products.index');
        Route::get('/products/status/{id}' , 'status')->name('seller.products.status');
        Route::get('/products/create', 'create')->name('seller.products.create');
        Route::post('/products/store', 'store')->name('seller.products.store');
        Route::get('/products/edit/{id}' , 'edit')->name('seller.products.edit');
        Route::get('/products/show/{id}', 'show')->name('seller.products.show');
        Route::post('/products/update', 'update')->name('seller.products.update');
        Route::get('/products/destroy/{id}', 'destroy')->name('seller.products.destroy');
    });

    // 🔹 SellerAnalyticsController CRUD Routes
    Route::controller(SellerAnalyticsController::class)->group(function () {
        Route::get('/sales-seller-location' , 'salesSellerLocation')->name('sales.seller.location');
        Route::get('/seller-get-sales-location' , 'getSellerSalesLocation')->name('get.seller.sales.location');
    });
});

Route::middleware(['visitor.track'])->group(function () {
    Route::controller(HomeController::class)->group(function(){
        Route::get('/' , 'index')->name('home');
        Route::get('/products/{product}/{id}' , 'product')->name('frontend.products.show');
        Route::get('/sellers/{seller}/{id}' , 'sellers')->name('frontend.sellers.show');
        Route::get('/categories/{category}/{id}' , 'category')->name('frontend.categories.show');
    });
});

Route::post('/search-data', [SearchController::class, 'getSearchData']);

require __DIR__.'/auth.php';
