<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->id())
        ->with(['images', 'sizes']) 
        ->get();        
        //
        return view('seller.product.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $sizes = Size::all();
        return view('seller.product.create', compact('categories', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        $request->validated();
        // dd($request->all());
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'seller_id' => Auth::guard('seller')->id(),
        ]);

        foreach ($request->sizes as $size) {
            ProductSize::create([
                'product_id' => $product->id,
                'size_id' => $size,
            ]);            
        }
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'seller_image');
                $product->images()->create([
                    'product_id' => $request->product_id,
                    'image' => $path
                ]);
            }
        }
        // dd($request->all());

        return to_route('seller.product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        $product = Product::find($product->id);
        return view('seller.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //

        $product->delete();

        return to_route('seller.product.index')->with('success', 'Product deleted successfully');

    }
}
