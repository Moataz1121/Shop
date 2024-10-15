<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============For View ==========================
Route::view('/shop' , 'user.index')->name('shop')->middleware(['auth' , 'verified']);
Route::view('/about' , 'user.info.about')->name('about');
Route::view('/product' , 'user.info.product')->name('product');
Route::view('single' , 'user.info.single-product')->name('single-product');
Route::view('contact' , 'user.info.contact')->name('contact');
Route::view('register/test' , 'user.auth.register')->name('register');
// =============End For View ==========================
require __DIR__.'/auth.php';

// for seller and admin
Route::prefix('/seller')->name('seller.')->group(function () {
    Route::view('/index' , 'seller.index')->name('index')->middleware(['seller', 'sellerVerified' ]);
    // Route::view('/register' , 'seller.auth.register')->name('register');
    // Route::view('/login' , 'seller.auth.login')->name('login');
    require __DIR__.'/sellerAuth.php';
});