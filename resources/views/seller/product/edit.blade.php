@extends('seller.master')


@section('content')
    <h3 class="text-center">Lets Edit this product</h3>
    <form action="{{route('seller.product.update', ['product' => $product->id])}}" enctype="multipart/form-data" method="POST" >
        @method('PUT')
        @csrf
        <div class="row shadow p-3 m-4">
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Name</label>
                <input name="name" value="{{$product->name}}" type="text" class="form-control" id="name">
                @error('name')
                     <span class="text-danger">{{ $message }}"</span>   
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="size" class="form-label">Size</label>
                <select name="sizes[]" class="form-control" id="size" multiple>
                    @foreach ($sizes as $size) 
                        <option value="{{$size->id}}">{{$size->size}}</option>)     
                    @endforeach                   
                </select>
                <small class="form-text text-muted">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple sizes.</small>
                @error('sizes')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        <div class="mb-3 col-6">
            <label for="name" class="form-label">Price</label>
            <input type="number" name="price" value="{{$product->price}}" class="form-control" id="name">
            @error('price')
                <span class="text-danger">{{ $message }}"</span>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="name" class="form-label">Choose Category</label>
            <select class="form-control"  name="category_id" id="">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <option class="form-control" value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('category_id')   
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="images" class="form-label">Upload Images</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
            <small class="form-text text-muted">You can select multiple images.</small>
            @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="card-body d-flex">
                @if($product->images->isNotEmpty())
                @foreach ($product->images as $image) 
              
                    <div class="d-flex flex-column justify-content-center m-2">
                        <img class="m-2"  src="{{ asset('images/seller_images/' . $image->image) }}" width="100px" height="100px" alt="Product Image">   
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <div class="col-12 mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description">{{$product->description}}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" value="Submit" class="btn btn-primary" name="" id="">
    </div>
    </form>

    @foreach ($product->images as $image) 
              
    <div class=" d-inline">
        <img class="m-2"  src="{{ asset('images/seller_images/' . $image->image) }}" width="100px" height="100px" alt="Product Image">
        <form action="{{ route('seller.destroy.image', ['product' => $product->id, 'image' => $image->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
        </form>
        
    </div>
                    @endforeach
   
@endsection

