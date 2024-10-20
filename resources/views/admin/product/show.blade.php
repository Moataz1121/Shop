@extends('admin.master')

@section('content')

<div class="bg-white shadow-sm rounded m-3">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Name : {{$product->name}}</h5>
                    <p class="card-text"> Description : {{$product->description}}</p>
                    <p class="card-text">Price : {{$product->price}}</p>
                    <p class="card-text">Category : {{$product->category->name}}</p>
                    <p class="card-text">Owner : {{$product->seller->name}}</p>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Images</h5>
                    @if($product->images->isNotEmpty())
                    @foreach ($product->images as $image) 
                        <img  src="{{ asset('images/seller_images/' . $image->image) }}" width="100px" height="100px" alt="Product Image">
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Status : {{$product->status}}</h5>
                    <p class="card-text">Created At : {{$product->created_at}}</p>
                <p class="card-text"> Are you want to change the status ?</p> 
                    <form action="{{route('admin.updateProduct', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <select name="status" id="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>

                    
                    </form>                
            </div>
            </div>
        </div>
    </div>
    {{-- <h1>{{$product->name}}</h1> --}}

</div>
@endsection