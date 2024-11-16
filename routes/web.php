<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerAuth\AuthenticatedSessionController;
use App\Http\Controllers\UserViewController;
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


Route::controller(ProductController::class)->name('product.')->group(function () {
Route::get('/product/index' , 'allProducts')->name('index');
Route::get('/product/{id}' , 'productDetails')->name('show');    
});

// Route::get('/product/men' , [UserViewController::class , 'getMenProducts'])->name('men');
Route::get('/shop' , [UserViewController::class , 'getMenProducts'])->name('shop');
// ==============For View ==========================
Route::view('/about' , 'user.info.about')->name('about');
// Route::view('/product' , 'user.info.product')->name('product');
Route::view('single' , 'user.info.single-product')->name('single-product');
Route::view('contact' , 'user.info.contact')->name('contact');
Route::view('register/test' , 'user.auth.register')->name('register');
Route::resource('subscriber' , 'App\Http\Controllers\SubscriberController')->names('subscriber');
// =============End For View ==========================
require __DIR__.'/auth.php';

// for seller and admin
Route::prefix('/seller')->name('seller.')->group(function () {
    Route::view('/index' , 'seller.index')->name('index')->middleware(['seller', 'sellerVerified' ]);
    // Route::view('/register' , 'seller.auth.register')->name('register');
    // Route::view('/login' , 'seller.auth.login')->name('login');
    require __DIR__.'/sellerAuth.php';
});

Route::resource('seller/product' , ProductController::class)->names('seller.product');

Route::get('/seller/log' , [AuthenticatedSessionController::class, 'create']);
Route::post('/seller/log' , [AuthenticatedSessionController::class, 'store'])->name('seller.logins');

Route::delete('seller/destroy/{product}/{image}', [ProductController::class, 'destroyImage'])->name('seller.destroy.image');
Route::put('seller/update/{product}', [ProductController::class, 'update'])->name('seller.update.image');

Route::get('/google/login/{type}', [GoogleController::class, 'login'])->name('google.login');
Route::get('/gmail/redirect', [GoogleController::class, 'redirect'])->name('gmail.redirect');



// =====================Seller Routes =======================

// ======================End Seller Routes ====================


// =====================Admin Routes =======================

Route::view('admin' , 'admin.index')->name('admin')->middleware(['admin']);
Route::resource('admin/category' , 'App\Http\Controllers\CategoryController')->names('admin.category');
// ======================End Admin Routes ====================


Route::controller(AdminController::class)->prefix('/admin')->group(function () {
   Route::get('/products' , 'getProducts')->name('admin.getProducts');
   Route::get('getProductDetails/{id}' , 'getProductDetails')->name('admin.getProductDetails');
   Route::put('updateProduct/{id}' , 'updateProduct')->name('admin.updateProduct'); 
   Route::get('send_email/{id}' , 'sendEmail')->name('admin.sendEmail');
   Route::post('send_email/{id}' , 'sendEmailPost')->name('admin.sendEmailPost');
});

// face book 
// Route::get('/auth/facebook', function () {
//     return Socialite::driver('facebook')->redirect();
// })->name('facebook');

// Route::get('/auth/facebook/callback', function () {
//     try{
//         $user = Socialite::driver('facebook')->stateless()->user();


    
//         $authUser = App\Models\User::updateOrCreate([
//             'facebook_id' => $user->getId(),
//         ], [
//             'name' => $user->getName(),
//             'email' => $user->getEmail(),
//             'password' => Hash::make('password'), 
//             'image' => $user->getAvatar(),
//             'email_verified_at' => now(),
//         ]);
    
//         Auth::login($authUser);
    
//         return to_route('shop');
//     }catch( Exception $e){
//         dd($e->getMessage());
//     }
   
// })->name('facebook.callback');
// end face book





Route::get('/products/category' , [FilterController::class , 'index'])->name('products.category');
Route::get('/products/filter', [ProductController::class, 'filterProducts'])->name('products.filter');
