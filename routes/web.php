<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;





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

});

// Route for viewing the cart
// Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
// Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('user.cart.remove');
// Route::post('/cart/buy', [CartController::class, 'buy'])->name('user.cart.buy');

// // Pending orders route
// Route::get('/pending', [CartController::class, 'pending'])->name('user.pending');

// Route::get('/cart', [CartController::class, 'showCart'])->name('user.cart');
//     Route::get('/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('user.addToCart');
//     Route::get('/remove-from-cart/{cartId}', [CartController::class, 'removeFromCart'])->name('user.removeFromCart');
//     Route::get('/clear-cart', [CartController::class, 'clearCart'])->name('user.clearCart');

//Route::get('user/cart/{id}', [ProductController::class, 'viewCart'])->name('user.cart');
//// Route for adding products to the cart
//Route::post('user/cart/{product}/add', [ProductController::class, 'addToCart'])->name('cart.add');
//// Route to remove an item from the cart
//Route::delete('user/cart/{cartItemId}/remove', [ProductController::class, 'removeCartItem'])->name('user.cart.remove');


// Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::delete('/cart/remove{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//Route::get('/user/cart/view/{id}', [UserController::class, 'viewCart'])->name('user.cart.view');
//Route::post('/user/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');


    //Route::get('/user/services', function() {
    //    $services = [];
    //    if (auth()->check()){
    //        $services = auth()->user()->services()->latest()->get();
    //
    //    }
    //    return view('user.services', compact('services'));
    //})->name('user.services');










require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';

require __DIR__.'/mechanic-auth.php';

