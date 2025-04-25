<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Seller\Auth\SellerAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// -----------------------------
// Admin Authentication Routes
// -----------------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'index')->name('login');           // Show login form
        Route::post('login', 'login');                         // Handle login
        Route::get('logout', 'destroy')->name('logout');       // Handle logout
    });
});

// -----------------------------
// Seller Authentication Routes
// -----------------------------
Route::prefix('seller')->name('seller.')->group(function () {
    Route::controller(SellerAuthController::class)->group(function () {
        Route::get('login', 'index')->name('login');           // Show login form
        Route::post('login', 'login');                         // Handle login
        Route::get('logout', 'destroy')->name('logout');       // Handle logout

        Route::get('register', 'create')->name('register');    // Show registration form
        Route::post('register', 'store')->name('store');       // Handle registration
    });
});

// routes/web.php
Route::post('/check-seller-field', [SellerAuthController::class, 'checkField'])->name('seller.checkField');
// -----------------------------
// Guest User Routes
// -----------------------------
Route::prefix('user')->middleware('guest')->name('user.')->group(function () {
    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('register', 'create')->name('register');    // Show registration form
        Route::post('register', 'store')->name('store');       // Handle registration
    });

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'index')->name('login');           // Show login form
        Route::post('login', 'login');                         // Handle login
    });
});

// -----------------------------
// Authenticated User Logout
// -----------------------------
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('logout', 'destroy')->name('logout');       // Handle logout
    });
});

// -----------------------------
// Redirect root /login to user login
// -----------------------------
Route::get('login', function () {
    return redirect()->route('user.login');
})->name('login');
