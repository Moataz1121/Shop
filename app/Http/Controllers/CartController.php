<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function index(){
        $cartItems = Cart::with('product') 
        ->where('user_id', Auth::id())
        ->get();

        return view('user.info.cart' , compact('cartItems'));
    }
    public function store(CartRequest $request){
        $request->validated();
        $cartItem = Cart::where('user_id', $request->user_id)
        ->where('product_id', $request->product_id)
        ->first();
        if($cartItem){
            $cartItem->increment('quantity');
        }else{
        Cart::create([
            'user_id' => $request->user_id,
            'product_id'=> $request->product_id,
        ]);

        return back()->with('message' , 'You Set the Product To Cart :) ');
    }
    return back()->with('message' , 'You Set the Product To Cart :) ');

}


public function destroy($id){
    $cartItem = Cart::where('id' , $id)->where('user_id' , Auth::id())->first();
    if(!$cartItem){
        return back()->with('error', 'Cart item not found or unauthorized.');
    }
    $cartItem->delete();
    return back()->with('message', 'Item removed from your cart.');

}
}
