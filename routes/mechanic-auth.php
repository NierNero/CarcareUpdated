<?php

use App\Http\Controllers\Mechanic\Auth\LoginController2;
use App\Http\Controllers\Mechanic\Auth\ConfirmablePasswordController2;
use App\Http\Controllers\Mechanic\Auth\EmailVerificationNotificationController2;
use App\Http\Controllers\Mechanic\Auth\EmailVerificationPromptController2;
use App\Http\Controllers\Mechanic\Auth\NewPasswordController2;
use App\Http\Controllers\Mechanic\Auth\PasswordController2;
use App\Http\Controllers\Mechanic\Auth\PasswordResetLinkController2;
use App\Http\Controllers\Mechanic\Auth\RegisteredUserController2;
use App\Http\Controllers\Mechanic\Auth\VerifyEmailController2;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;


use Illuminate\Support\Facades\Route;

Route::prefix('mechanic')->middleware('guest:mechanic')->group(function () {
    Route::get('register', [RegisteredUserController2::class, 'create'])
                ->name('mechanic.register');

    Route::post('register', [RegisteredUserController2::class, 'store']);

    Route::get('login', [LoginController2::class, 'create'])
                ->name('mechanic.login');

    Route::post('login', [LoginController2::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController2::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController2::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController2::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController2::class, 'store'])
                ->name('password.store');
});

Route::prefix('mechanic')->middleware('auth:mechanic')->group(function () {
    Route::get('/productdashboard', function () {
        $products = [];
        if (auth()->check()){
            $products = auth()->user()->products()->latest()->get();

        }
        return view('mechanic.productdashboard', compact('products'));
    })->name('mechanic.productdashboard');

    Route::get('/dashboard', function () {
        $services = [];
        if (auth()->check()){
            $services = auth()->user()->services()->latest()->get();

        }
        return view('mechanic.dashboard', compact('services'));
    })->name('mechanic.dashboard');

    //Route::get('/user/services', function() {
    //    $services = [];
    //    if (auth()->check()){
    //        $services = auth()->user()->services()->latest()->get();
//
    //    }
    //    return view('user.services', compact('services'));
    //})->name('user.services');


    Route::get('verify-email', EmailVerificationPromptController2::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController2::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController2::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController2::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController2::class, 'store']);

    Route::put('password', [PasswordController2::class, 'update'])->name('password.update');

    Route::post('logout', [LoginController2::class, 'destroy'])
                ->name('mechanic.logout');

     
});

Route::get('/mechanic/orders', function () {
    return view('mechanic.orders');
        
})->name('orders');
    
Route::get('/mechanic/report', function () {
        return view('mechanic.auth.report');
        
})->name('report');

Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');
Route::delete('/admin/{mechanics}', [AdminController::class, 'delete'])->name('mechanic.destroy');

//for Product Mechanic Service

    Route::get('/mechanic/dashboard', [ServiceController::class, 'shwservice'])->name('mechanic.dashboard');
    Route::get('/mechanic/services/create', [ServiceController::class, 'add'])->name('mechanic.service.add');
    Route::post('/mechanic/services', [ServiceController::class, 'storage'])->name('mechanic.storage');
    Route::get('/mechanic/services/{service}', [ServiceController::class, 'shows'])->name('mechanic.shows');
    Route::delete('/mechanic/services/{service}', [ServiceController::class, 'destroys'])->name('mechanic.destroys');
    Route::get('/mechanic/service/{service}/edit', [ServiceController::class, 'edit'])->name('mechanic.edit');
Route::put('/mechanic/service/{service}', [ServiceController::class, 'update'])->name('mechanic.service.update');

    //for Product Mechanic Product

    Route::get('/mechanic/productdashboard', [ProductController::class, 'showprod'])->name('mechanic.productdashboard');
    Route::get('/mechanic/products/created', [ProductController::class, 'created'])->name('mechanic.created');
    Route::post('/mechanic/products', [ProductController::class, 'store'])->name('mechanic.store');
    Route::get('/mechanic/products/{product}', [ProductController::class, 'show'])->name('mechanic.show');
    Route::delete('/mechanic/products/{product}', [ProductController::class, 'destroy'])->name('mechanic.destroy');
    Route::get('/mechanic/products/{product}/edit', [ProductController::class, 'edit'])->name('mechanic.product.edit');
    Route::put('/mechanic/products/{product}', [ProductController::class, 'update'])->name('mechanic.update');

    Route::get('/mechanic/order', [OrderController::class, 'show'])->name('mechanic.order');

    //Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
    Route::post('/mechanic/create', [MechanicController::class, 'store'])->name('mechanic.create');
    Route::post('/mechanic/dashboard', [MechanicController::class, 'index'])->name('mechanic.dashboard');
    Route::post('/mechanic/logout', [MechanicController::class, 'logout'])->name('mechanic.logout');



    Route::get('/mechanic/booking/bookingdashboard', [BookingController::class, 'show'])
    ->name('mechanic.booking.bookingdashboard')
    ->middleware('auth:mechanic');
    Route::get('/mechanic/bookings', [BookingController::class, 'show'])->name('mechanic.booking.show'); // List all bookings


    // Mechanic booking routes
// Mechanic booking routes


// In Transit route for users

// Complete order route for users
// Complete order route for users

// Completed orders routes

Route::middleware('auth:mechanic')->group(function () {
    Route::get('/mechanic/orders', [MechanicController::class, 'orders'])->name('mechanic.orders');
    Route::get('/mechanic/orders/{order}', [MechanicController::class, 'showOrder'])->name('mechanic.orders.show');
    Route::post('/mechanic/orders/{order}/update-status', [MechanicController::class, 'updateOrderStatus'])->name('mechanic.orders.updateStatus');
    // Route::get('/mechanic', [MechanicController::class, 'index'])->name('mechanic.index');

});

Route::middleware('auth')->group(function () {
    // Payment page
    Route::post('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{productId}', [PaymentController::class, 'index'])->name('payments.buyNow');

    // Process payment
    Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
});