<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $cartItems = $request->input('cartItems'); // Retrieve cart items
        $total = $request->input('total'); // Retrieve the total price

        return view('user.payment.index', compact('cartItems', 'total'));
    }

    public function stripe(Request $request){
        $price = (float) $request->price;
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $response = $stripe->checkout->sessions->create([
            'line_items'=>[
               [ 'price_data' => [
                    'currency' => 'USD',
                    'product_data'=> [
                        'name' => $request->product_name
                    ],
                    'unit_amount' => $price
                ],
                'quantity' => $request->quantity
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('payment.success'). '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('payment.cancel'),
        'metadata' => [
            'product_name' => $request->input('product_name'),
            'quantity' => $request->input('quantity', 1),
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
        ],
        ]);
     

        if(isset($response->id) && $response->id != ''){
            session()->put('product_name' , $request->product_name);
            session()->put('quantity' , $request->quantity);
            session()->put('price' , $request->price);
            return redirect($response->url);
        }else{
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request){

        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        // $response = $str;
        if ($request->has('session_id')) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->retrieve($request->input('session_id'));

            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = $response->metadata->product_name;
            $payment->amount = $response->amount_total / 100;
            $payment->quantity = $response->metadata->quantity;
            $payment->currency = $response->currency;
            $payment->payer_name = $response->customer_details->name ?? 'N/A';
            $payment->payer_email = $response->customer_details->email ?? 'N/A';
            $payment->payment_status = $response->payment_status;
            $payment->payment_method = 'Stripe';
            $payment->save();
            $product = Product::where('id' , $response->metadata->product_id)->first();
            $seller = Seller::where('id' , $product->seller_id)->first();
            $seller->wallet += $response->amount_total / 100;
            $seller->save();
            Booking::create([
                'user_id' => $response->metadata->user_id,
                'product_id' => $response->metadata->product_id,
                'seller_id' => $seller->id,
                'booked_at' => now(),
            ]);
        return view('user.payment.success');

    }
    return view('user.payment.cancel'); 

    }

    public function cancel () {
        return view('user.payment.cancel'); 
      
    }


    public function showBookings(){
        $seller = auth('seller')->user();
        $bookings = Booking::with(['user', 'product'])->where('seller_id' , $seller->id)->get();
        
        return view('seller.booking' , compact('bookings'));
    }
}
