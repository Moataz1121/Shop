@extends('seller.master')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <h1 class="text-center">Products</h1>
    <a href="{{route('seller.product.create')}}" class="btn btn-primary"> Add Product</a>
@endsection