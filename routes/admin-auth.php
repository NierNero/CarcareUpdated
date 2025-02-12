<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController1;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController1;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController1;
use App\Http\Controllers\Admin\Auth\NewPasswordController1;
use App\Http\Controllers\Admin\Auth\PasswordController1;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController1;
use App\Http\Controllers\Admin\Auth\RegisteredUserController1;
use App\Http\Controllers\Admin\Auth\VerifyEmailController1;
use App\Http\Controllers\Admin\Auth\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController1::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredUserController1::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController1::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController1::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController1::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController1::class, 'store'])
                ->name('password.store');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('verify-email', EmailVerificationPromptController1::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController1::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController1::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController1::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController1::class, 'store']);

    Route::put('password', [PasswordController1::class, 'update'])->name('password.update');

    Route::post('logout', [LoginController::class, 'destroy'])
                ->name('admin.logout');
});


// Routes for booking and report
Route::get('/admin/adminbooking', function () {
    return view('admin.auth.adminbooking');
})->name('adminbooking');
    
Route::get('/admin/adminreport', function () {
    return view('admin.auth.adminreport');
})->name('adminreport');

// Routes for dashboard and deleting users and mechanics
Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');


// Routes to view user and mechanic details
Route::get('/admin/user/view/{id}', [AdminController::class, 'viewUser'])->name('admin.user.view');
Route::get('/admin/mechanic/view/{id}', [AdminController::class, 'viewMechanic'])->name('admin.mechanic.view');

// Separate delete routes for user and mechanic
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
Route::delete('/admin/mechanic/{id}', [AdminController::class, 'destroy'])->name('admin.mechanic.destroy');



