<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function createStripeSession(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'product_name' => 'required|string',
                'price' => 'required|numeric|min:0.01',
                'quantity' => 'required|integer|min:1',
                'product_id' => 'required|integer',
            ]);

            $price = (float)$validated['price'] * 100; // Convert to cents for Stripe
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            // Create a Stripe Checkout Session
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'USD',
                            'product_data' => [
                                'name' => $validated['product_name'],
                            ],
                            'unit_amount' => $price,
                        ],
                        'quantity' => $validated['quantity'],
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('api.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('api.payment.cancel'),
                'metadata' => [
                    'product_name' => $validated['product_name'],
                    'quantity' => $validated['quantity'],
                    'user_id' => Auth::id(),
                    'product_id' => $validated['product_id'],
                ],
            ]);

            // Return the checkout session URL
            return response()->json([
                'status' => 'success',
                'message' => 'Checkout session created successfully.',
                'checkout_url' => $response->url,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle successful payment
     */
    public function success(Request $request)
    {
        try {
            // Validate the request
            $sessionId = $request->input('session_id');
            if (!$sessionId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Session ID is missing.',
                ], 400);
            }

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            // Retrieve the Stripe session details
            $response = $stripe->checkout->sessions->retrieve($sessionId);

            // Save payment details to the database
            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = $response->metadata->product_name;
            $payment->amount = $response->amount_total / 100; // Convert to dollars
            $payment->quantity = $response->metadata->quantity;
            $payment->currency = $response->currency;
            $payment->payer_name = $response->customer_details->name ?? 'N/A';
            $payment->payer_email = $response->customer_details->email ?? 'N/A';
            $payment->payment_status = $response->payment_status;
            $payment->payment_method = 'Stripe';
            $payment->save();

            // Update the seller's wallet
            $product = Product::findOrFail($response->metadata->product_id);
            $seller = Seller::findOrFail($product->seller_id);
            $seller->wallet += $response->amount_total / 100; // Convert to dollars
            $seller->save();

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Payment processed successfully.',
                'payment' => $payment,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle canceled payment
     */
    public function cancel()
    {
        return response()->json([
            'status' => 'canceled',
            'message' => 'Payment was canceled by the user.',
        ]);
    }
}
