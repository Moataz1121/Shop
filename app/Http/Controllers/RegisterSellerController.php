<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
class RegisterSellerController extends Controller
{
    //

    public function store(Request $request){
        $validtor = Validator::make($request->all(), [
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:sellers'],
           'password' => ['required', 'confirmed', Rules\Password::defaults()],
           'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
           'phone' => ['required', 'string', 'max:20'],
           'gender' => ['required', 'string'],
        ]);

           if($validtor->fails()){
            return response()->json($validtor->errors(), 400);
        }
        $image_path = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_path = $image->store('images', 'seller_image');
        }

        $user = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_path,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);
        // Auth::;
        Auth::guard('seller')->login($user , true);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Registration successfull',
            'access_token' => $token,
        ]);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(!Auth::guard('seller')->attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = Seller::where('email', $request->email)->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successfull',
            'access_token' => $token
        ]);
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successfull'
        ]);
    }

}
