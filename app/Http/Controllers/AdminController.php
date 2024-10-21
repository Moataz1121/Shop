<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //

    public function getProducts(Request $request)
    {
        // Get the 'status' parameter from the request, default to null if not set
        $status = $request->input('status');
    
        // Query the products based on the status if provided
        if ($status) {
            $products = Product::where('status', $status)->get();
        } else {
            $products = Product::all();
        }
    
        return view('admin.product.index', compact('products'));
    }

    public function getProductDetails($id){

        $product = Product::with(['images', 'sizes'])->findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    public function updateProduct($id, Request $request){

        $product = Product::findOrFail($id);
        // dd('ss');
        $product->update($request->all());

        return to_route('admin.sendEmail' , ['id' => $id]);
    }

    public function sendEmail($id){

        $product = Product::findOrFail($id);
        return view('admin.send' , compact('product'));
    }


    public function sendEmailPost($id, Request $request){
            $seller = Seller::findOrFail($id);
            $details = [
                'mail_greeting' => $request->mail_greeting,
                'mail_body' => $request->mail_body,
                'mail_action_text' => $request->mail_action_text,
                'mail_action_url' => $request->mail_action_url,
                'mail_end_line' => $request->mail_end_line,
            ];

            Notification::send($seller, new \App\Notifications\SendEmailNotification($details));
            return redirect()->back();
        }
}    
