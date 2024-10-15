<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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


// face book 
Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('facebook');

Route::get('/auth/facebook/callback', function () {
    try{
        $user = Socialite::driver('facebook')->stateless()->user();


    
        $authUser = App\Models\User::updateOrCreate([
            'facebook_id' => $user->getId(),
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make('password'), 
            'image' => $user->getAvatar(),
            'email_verified_at' => now(),
        ]);
    
        Auth::login($authUser);
    
        return to_route('shop');
    }catch( Exception $e){
        dd($e->getMessage());
    }
   
})->name('facebook.callback');
// end face book