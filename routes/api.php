<?php

use App\Http\Controllers\GmailController;
use App\Http\Controllers\RegisterSellerController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(GmailController::class)->group(function () {
    Route::get('/gmail/login', 'login')->name('gmail.login');
    Route::get('/owner/gmail/login', ('loginOwner'))->name('owner.gmail.login');
    Route::get('/gmail/redirect', 'redirect')->name('gmail.redirect');
});


Route::post('register' , [RegisterUserController::class, 'store']);
Route::post('login' , [RegisterUserController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [RegisterUserController::class, 'logout']);

Route::post('seller/register' , [RegisterSellerController::class, 'store']);
Route::post('seller/login' , [RegisterSellerController::class, 'login']);
Route::post('seller/logout' , [RegisterSellerController::class, 'logout'])->middleware('auth:sanctum');