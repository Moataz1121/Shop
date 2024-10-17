@extends('admin.master')

@section('content')

<div class="container">

    <form action="{{route('admin.category.store')}}" method="post">
        @csrf
        <label for="" class="form-label fs-2">Add Category</label>
        <input type="text" name="name" class="form-control w-50" id="" placeholder="Add Category">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
@endsection