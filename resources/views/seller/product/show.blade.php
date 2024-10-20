@extends('seller.master')
@section('content')
<h1 class="text-center my-2"> Your Product Details</h1>

<div class="container"></div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Name: {{$product->name}}</h5>
                    <p class="card-text">Price: {{$product->price}}</p>
                    <p class="card-text">Category: {{$product->category->name}}</p>
                    <p class="card-text">Description: {{$product->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if($product->images->isNotEmpty())
                    @foreach ($product->images as $image) 
                        <img  src="{{ asset('images/seller_images/' . $image->image) }}" width="100px" height="100px" alt="Product Image">
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection