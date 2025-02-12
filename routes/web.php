<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;





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


Route::get('/services', function () {
    return view('services');
})->middleware(['auth', 'verified'])->name('services');

Route::get('/usershop', function () {
    return view('usershop');
})->middleware(['auth', 'verified'])->name('usershop');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [UserController::class, 'showMechananic'])->name('dashboard');


Route::get('/mechanic/view/{id}', [UserController::class, 'viewMechanic'])->name('mechanic.view');

Route::get('/mechanic/{id}/services', [UserController::class, 'viewMechanic'])->name('user.services');






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

