@extends('seller.master')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-center">Products</h1>
    <a href="{{ route('seller.product.create') }}" class="btn btn-primary"> Add Product</a>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $cat)
                <tr>
                    <th scope="row" class="text-center">{{ $cat->id }}</th>
                    <td class="text-center">{{ $cat->name }}</td>
                    <td class="text-center">{{ $cat->category->name }}</td>
                    <td class="text-center">{{ $cat->price }}</td>

                    



                    <td class="text-center product-images">
                        @if($cat->images->isNotEmpty()) <!-- Check if there are images -->
                            <img src="{{ asset('images/seller_images/' . $cat->images->first()->image) }}" width="100px" height="100px" alt="Product Image">
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('seller.product.edit', $cat->id) }}" class="btn btn-warning">Edit</a>
                        <form class="d-inline" action="{{ route('seller.product.destroy', $cat->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                        </form>
                        <a href="{{ route('seller.product.show', $cat->id) }}" class="btn btn-info">Show</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
