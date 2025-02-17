<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MechanicOrderListController;






Route::get('/', function () {
    return view('welcome');
});

//Route::get('/visit', function () {
//    return view('visit');
//});


//Route::get('/dashboard', function () {
//    return view('dashboard');
//    
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::prefix('user')->middleware('auth:user')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/booknow', function () {
    return view('booknow');

})->middleware(['auth', 'verified'])->name('booknow');


Route::get('/booking', function () {
    return view('booking');
})->middleware(['auth', 'verified'])->name('booking');

Route::get('/cart', function () {
    return view('cart');
})->middleware(['auth', 'verified'])->name('cart');


//Route::get('/services', function () {
//    return view('services');
//})->middleware(['auth', 'verified'])->name('services');

Route::get('/usershop', function () {
    return view('usershop');
})->middleware(['auth', 'verified'])->name('usershop');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [UserController::class, 'showMechanic'])->name('dashboard');

//User Service
Route::get('/mechanic/view/{id}', [UserController::class, 'viewMechanic'])->name('mechanic.view');

Route::get('/mechanic/{id}/services', [UserController::class, 'viewMechanic'])->name('user.services');

//User Product
Route::get('/mechanic/view/{id}', [UserController::class, 'viewMechanics'])->name('mechanic.view');

Route::get('/mechanic/{id}/product', [UserController::class, 'viewMechanics'])->name('user.product');

//Cart Product
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware('auth')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
});

Route::get('/user/pending', [OrderController::class, 'pendingOrders'])->name('user.pending');
    Route::get('/user/in-transit', [OrderController::class, 'inTransitOrders'])->name('user.in_transit');
    Route::get('/user/denied', [OrderController::class, 'deniedOrders'])->name('user.denied');
    Route::get('/user/completed', [OrderController::class, 'completedOrders'])->name('user.completed');










require __DIR__ . '/auth.php';

require __DIR__ . '/admin-auth.php';

require __DIR__ . '/mechanic-auth.php';

