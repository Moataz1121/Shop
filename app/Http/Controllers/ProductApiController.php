<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\StoreProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class ProductApiController extends Controller
{
    //

    public function index(){
        $products = Product::all();
        return ApiResponse::sendResponse(200, 'success', $products);
    }


    public function store(Request $request)
    {
        // Validate request data
        $validtor = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255',],
            'image' => ['required', 'array'], // Validate that 'images' is an array
            'image.*' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],             // Validation for each image in the array 
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'sizes' => ['required', 'array'],

 
         ]);

        if ($validtor->fails()) {
            return ApiResponse::sendResponse(400, 'Validation failed', $validtor->errors());
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'seller_id' => $request->seller_id,

        ]);

        foreach ($request->sizes as $size) {
            ProductSize::create([
                'product_id' => $product->id,
                'size_id' => $size,
            ]);            
        }
        if($request->hasFile('image')){
            foreach ($request->file('image') as $image) {
                $path = $image->store('images', 'seller_image');
                $product->images()->create([
                    'product_id' => $request->product_id,
                    'image' => $path
                ]);
                // Image::create([
                //     'product_id' => $product->id,
                //     'image' => $path
                // ]);
            }

        return ApiResponse::sendResponse(200, 'success', $product);
    }
    

}


public function update(Request $request, $id)
{
    $validtor = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255',],
        'image' => ['required', 'array'], // Validate that 'images' is an array
        'image.*' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],             // Validation for each image in the array 
        'price' => ['required', 'numeric'],
        'category_id' => ['required', 'exists:categories,id'],
        'sizes' => ['required', 'array'],
    ]);
    if ($validtor->fails()) {
        return ApiResponse::sendResponse(400, 'Validation failed', $validtor->errors());
    }
    $product = Product::find($id);
    $product->sizes()->sync($request->sizes);
    if  ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
            $path = $image->store('images', 'seller_image');
            $product->images()->create([
                'product_id' => $request->product_id,
                'image' => $path
            ]);
        }
    
    $product->update($product);
    return ApiResponse::sendResponse(200, 'success', $product);
}
}
}