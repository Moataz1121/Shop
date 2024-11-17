<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartControllerApi extends Controller
{
    //
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cartItems,
        ], 200);
    }

    // Add a product to the cart
    public function store(CartRequest $request)
    {
        $request->validated();

        $cartItem = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated for the product in your cart.',
                'data' => $cartItem,
            ], 200);
        } else {
            $newCartItem = Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to your cart.',
                'data' => $newCartItem,
            ], 201);
        }
    }

    // Delete a cart item
    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found or unauthorized.',
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from your cart.',
        ], 200);
    }
}
