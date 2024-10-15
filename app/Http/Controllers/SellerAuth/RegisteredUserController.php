<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('seller.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Seller::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'in:male,female'],
            'image' => [ 'required','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone' => ['required', 'string', 'max:20'],
        ]);
        
            $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('images', 'seller_image');
        }
        $user = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'image' => $image_path,

        ]);

        event(new Registered($user));

        Auth::guard('seller')->login($user);

        return to_route('seller.index');
    }
}
