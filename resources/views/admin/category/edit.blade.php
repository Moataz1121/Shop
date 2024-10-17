@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="bg-white shadow-sm rounded p-4">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" class="form-control w-50" id=""  value="{{$category->name}}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>

    </div>

@endsection