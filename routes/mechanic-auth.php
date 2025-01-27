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

    Route::get('/dashboard', function () {
        return view('mechanic.dashboard');
    })->name('mechanic.dashboard');

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

Route::get('/mechanic/order', function () {
    return view('mechanic.order');
        
})->name('order');
    
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
    Route::get('/mechanic/products/create', [ProductController::class, 'create'])->name('mechanic.create');
    Route::post('/mechanic/products', [ProductController::class, 'store'])->name('mechanic.store');
    Route::get('/mechanic/products/{product}', [ProductController::class, 'show'])->name('mechanic.show');
    Route::delete('/mechanic/products/{product}', [ProductController::class, 'destroy'])->name('mechanic.destroy');
    Route::get('/mechanic/products/{product}/edit', [ProductController::class, 'edit'])->name('mechanic.product.edit');
    Route::put('/mechanic/products/{product}', [ProductController::class, 'update'])->name('mechanic.update');

    Route::get('/mechanic/order', [OrderController::class, 'shworder'])->name('mechanic.order');

    //Route::get('/mechanic/dashboard', [MechanicController::class, 'index'])->name('mechanic.dashboard');


    Route::get('/mechanic/bookings', [BookingController::class, 'show'])->name('mechanic.booking.show');   // List all bookings
Route::get('/mechanic/bookings/create', [BookingController::class, 'create'])->name('mechanic.booking.create'); // Show form to create a booking
Route::post('/mechanic/bookings', [BookingController::class, 'store'])->name('mechanic.booking.store');   // Store new booking
Route::delete('/mechanic/bookings/{booking}', [BookingController::class, 'destroy'])->name('mechanic.booking.destroy'); // Delete booking
Route::get('/mechanic/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('mechanic.booking.edit'); // Show form to edit a booking
Route::put('/mechanic/bookings/{booking}', [BookingController::class, 'update'])->name('mechanic.booking.update'); // Update booking

    