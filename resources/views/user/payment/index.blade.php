@extends('user.info.master')
@section('title', 'Payment')
@section('content')
<div class="container">
    <h1>Payment Page</h1>
    
    <h3>Products:</h3>
    <ul>
        @foreach($cartItems as $item)
        {{-- @dd($item)     --}}
        <li>{{ $item['name'] }} - ${{ number_format($item['subtotal'], 2) }}</li>
           
            @endforeach
    </ul>
    
    <h3>Total: ${{ number_format($total, 2) }}</h3>
    <form action="{{route('payment.stripe')}}" method="POST">
        @csrf
        <input type="hidden" name="price" value="{{ $total }}">
        <input type="hidden" name="product_name" value="{{$item['name']}}">
        <input type="hidden" name="product_id" value="{{$item['id']}}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <button type="submit" class="btn btn-primary">Payment With Stripe</button>
    </form>
    <!-- Add payment form or button here -->
    
</div>
@endsection
