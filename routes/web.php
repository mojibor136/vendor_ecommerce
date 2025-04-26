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
use App\Http\Controllers\Admin\Backend\Company\CompanyController;
use App\Http\Controllers\Admin\Backend\User\UserController;
use App\Http\Controllers\Admin\BackEnd\Subscription\SubscriptionController;
use App\Http\Controllers\Admin\BackEnd\Order\OrderController;
use App\Http\Controllers\Admin\Backend\Seller\SellerController as BackendSellerController;
use App\Http\Controllers\Admin\Backend\Location\DivisionController;
use App\Http\Controllers\Admin\Backend\Location\DistrictController;
use App\Http\Controllers\Admin\Backend\Location\CountryController;
use App\Http\Controllers\Admin\Backend\Analytics\AnalyticsController;
use App\Http\Controllers\Admin\Backend\Payment\PaymentGatewayController;
// Front-End Routes
use App\Http\Controllers\FrontEnd\HomeController;

// 🔐 Auth Routes (Laravel Breeze / Fortify ইত্যাদি ইউজ করলে এখানে থাকে)
require __DIR__.'/auth.php';

// 🛡️ Admin Routes Group (Only accessible if admin is authenticated)
Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.index');
    Route::get('/{id}/edit', 'edit')->name('admin.edit');
    Route::put('/{id}', 'update')->name('admin.update');
    Route::delete('/{id}', 'destroy')->name('admin.destroy');
});

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
        Route::get('/products/destroy/{id}', 'destroy')->name('products.destroy');
    });

    // 🔹 CompanyController CRUD Routes
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/company/api' , 'api')->name('company.api');
        Route::get('/company', 'index')->name('company.index');
        Route::get('/company/create', 'create')->name('company.create');
        Route::post('/company/store', 'store')->name('company.store');
        Route::get('/company/edit/{id}' , 'edit')->name('company.edit');
        Route::get('/company/show/{id}', 'show')->name('company.show');
        Route::post('/company/update', 'update')->name('company.update');
        Route::get('/company/destroy/{id}', 'destroy')->name('company.destroy');
    }); 

    // 🔹 SubscriptionController CRUD Routes
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/subscription/api' , 'api')->name('subscription.api');
        Route::get('/subscription', 'index')->name('subscription.index');
        Route::get('/subscription/create', 'create')->name('subscription.create');
        Route::post('/subscription/store', 'store')->name('subscription.store');
        Route::get('/subscription/edit/{id}' , 'edit')->name('subscription.edit');
        Route::post('/subscription/update', 'update')->name('subscription.update');
        Route::get('/subscription/show/{id}', 'show')->name('subscription.show');
        Route::get('/subscription/destroy/{id}', 'destroy')->name('subscription.destroy');
    });

    // 🔹 OrderController CRUD Routes
     Route::controller(OrderController::class)->group(function () {
        Route::get('/order/api' , 'api')->name('order.api');
        Route::get('/order', 'index')->name('order.index');
        Route::get('/order/status/{id}' , 'status')->name('order.status');
        Route::get('/order/show/{shop_name}/{id}', 'show')->name('order.show');
        Route::get('/order/destroy/{id}', 'destroy')->name('order.destroy');
    });

    
    // 🔹 PaymentGatewayController CRUD Routes
    Route::controller(PaymentGatewayController::class)->group(function () {
        Route::get('/payment-gateway', 'index')->name('payment-gateway.index');
        Route::get('/payment-gateway/create', 'create')->name('payment-gateway.create');
        Route::post('/payment-gateway/store', 'store')->name('payment-gateway.store');
        Route::get('/payment-gateway/edit/{id}', 'edit')->name('payment-gateway.edit');
        Route::post('/payment-gateway/update/{id}', 'update')->name('payment-gateway.update');
        Route::get('/payment-gateway/destroy/{id}', 'destroy')->name('payment-gateway.destroy');
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
        Route::get('/seller', 'index')->name('seller.index');
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
        Route::get('/sales-report', 'index')->name('sales.report');
        Route::get('/seller-location' , 'sellerLocation')->name('seller.location');
        Route::get('/get-seller-location' , 'getSellerLocation')->name('get.seller.location');
        Route::get('/sales-location' , 'salesLocation')->name('sales.location');
        Route::get('/get-sales-location' , 'getSalesLocation')->name('get.sales.location');
        Route::get('/sales-report/data' , 'getSellersData')->name('sales.report.data');
        Route::get('/seller-orders/{shop_name}/{sellerId}', 'showSellerOrders')->name('show.seller.orders');
    });
            
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
    });
});

require __DIR__.'/auth.php';
