<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    //

    public function getMenProducts()
    {
        $products = Product::with(['images', 'sizes'])->where('category_id', 1)->get();
        $womenProducts = Product::with(['images', 'sizes'])->where('category_id', 3)->get();        // return view('user.master', compact('products'));
        // return view('user.master', compact('products'));
        // dd($womenProducts);
        $categories = Category::all();
        $kidsProducts = Product::with(['images', 'sizes'])->where('category_id', 4)->get();
        return view('user.index', compact('products' , 'womenProducts' , 'kidsProducts' , 'categories'));     

    }

    // public function getWomenProducts()
    // {
    //     return view('user.index', compact('productsWomens'));
    // }
}
