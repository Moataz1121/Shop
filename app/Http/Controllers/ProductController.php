<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


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
        $product = Product::find($product->id);
        $categories = Category::all();
        $sizes = Size::all();
        return view('seller.product.edit', compact('product', 'categories', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $request->validated();
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'seller_image');
                $product->images()->create([
                    'product_id' => $request->product_id,
                    'image' => $path
                ]);
            }
        }
        foreach ($request->sizes as $size) {
            ProductSize::updateOrCreate([
                'product_id' => $product->id,
                'size_id' => $size,
            ],[
                'product_id' => $product->id,
                'size_id' => $size,
            ]);             
        }

        return to_route('seller.product.index')->with('success', 'Product updated successfully');
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

    public function destroyImage($productId, $imageId)
{
    // Find the image by its id and ensure it belongs to the specified product
    $image = Image::where('id', $imageId)->where('product_id', $productId)->first();

    // Check if the image exists
    if (!$image) {
        return redirect()->back()->with('error', 'Image not found.');
    }

    // Delete the image from the storage
    Storage::disk('seller_image')->delete($image->image); // Delete the actual image file

    // Delete the image record from the database
    $image->delete();

    return redirect()->route('seller.product.edit', $productId)->with('success', 'Image deleted successfully');
}

public function allProducts(){
    $categories = Category::all();
    $products = Product::where('status', 'accepted')->with(['images', 'sizes'])->paginate(1);
    // dd($products);
    return view('user.info.product', compact('products' , 'categories'));
}


public function productDetails($id){
    $product = Product::where('id', $id)->with(['images', 'sizes'])->first();
    // dd($product);
    return view('user.info.single-product', compact('product'));
}

public function filterProducts(Request $request)
{
    $categories = Category::all();
    if ($request->has('category_id') && $request->category_id != '') {
        $products = Product::where('category_id', $request->category_id)
                           ->where('status', 'accepted')
                           ->with(['images', 'sizes'])
                           ->paginate(1);
    } else {
        $products = Product::where('status', 'accepted')
                           ->with(['images', 'sizes'])
                           ->paginate(1);
    }

    return view('user.info.product', compact('products', 'categories'));
}

}