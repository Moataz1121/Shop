<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Function to handle login request for user or seller
    public function login($type)
    {
        // Save the type (user or seller) in session
        session(['login_type' => $type]);

        return Socialite::driver('google')->redirect();
    }

    // Function to handle the callback from Google
    public function redirect(Request $request)
    {
        // Get the login type from session
        $type = session('login_type');

        // Get the Google user data
        $googleUser = Socialite::driver('google')->user();

        if ($type === 'seller') {
            $seller = Seller::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'image' => $googleUser->getAvatar(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'provider_id' => $googleUser->getId(),
            ]);

            Auth::guard('seller')->login($seller);

            return to_route('seller.index');
        } else {
            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'image' => $googleUser->getAvatar(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'google_id' => $googleUser->getId(),
            ]);

            Auth::login($user);

            return to_route('shop');
        }
    }
}
