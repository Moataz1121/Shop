<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function login(){
        return Socialite::driver('google')->redirect();
    }

    public function redirect(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ],[
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'image' => $googleUser->getAvatar(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'facebook_id' => $googleUser->getId(),
        ]);
        Auth::login($user);
        return to_route('shop');
        // dd($user);
    }
}
