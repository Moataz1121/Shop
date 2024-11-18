@extends('user.info.master')
@section('title', 'cart')
@section('content')
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Single Product Page</h2>
                    <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->


<!-- ***** Product Area Starts ***** -->
<section class="section" id="product">
    <div class="container">
        <h1>Your Cart</h1>
    
        @if($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td><img style="width:80px" src="{{ asset('images/seller_images/' . $item->product->images[0]->image) }}" alt=""></td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td>
                                <form action="{{route('cart.delete' , $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')    
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td>
                            <td>
                                <a 
                                href="{{ route('payment.index', [
                                    'cartItems' => $cartItems->map(fn($item) => [
                                        'name' => $item->product->name,
                                        'subtotal' => $item->product->price * $item->quantity,
                                        'id' => $item->product->id
                                    ])->toArray(),
                                    'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity)
                                ]) }}" 
                                class="btn btn-success"
                            >
                                Proceed to Payment
                            </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <strong>Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</strong>
            </div>
        @endif
    </div>
</div>

</section>
@endsection