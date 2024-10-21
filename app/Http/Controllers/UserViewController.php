<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    //

    public function getMenProducts()
    {
        $products = Product::where('category_id', 1)->get();
        return view('user.master', compact('products'));

    }
}
