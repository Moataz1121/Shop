<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $product->update($request->all());

        return redirect()->back();
    }
}    
