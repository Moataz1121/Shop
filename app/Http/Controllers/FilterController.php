<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //

    public function index(){
        return view('user.products');
    }
    public function getProductsByCategory(Request $request)
    {
        $category = $request->category;
        $products = Product::where('category', $category)->get();
        return response()->json($products);
    }
}
