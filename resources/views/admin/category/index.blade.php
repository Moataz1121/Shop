@extends('admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        {{session('message')}}
    </div>
@endif
<div class="bg-white shadow-sm rounded">
    <a href="{{route('admin.category.create')}}" class="btn btn-primary m-3 w-25"> Add Category</a>

@if (count($categories) > 0)
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Name</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categories as $cat) 
        <tr>
            <th scope="row" class="text-center">{{$cat->id}}</th>
            <td class="text-center">{{$cat->name}}</td>
            <td class="text-center">
                <a href="{{route('admin.category.edit', $cat->id)}}" class="btn btn-warning">Edit</a>
                  <form class="d-inline" action="{{route('admin.category.destroy', $cat->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  </form>
                <a href="{{route('admin.category.show', $cat->id)}}" class="btn btn-info">Show</a>
            </td>
            
          </tr>
        @endforeach
@endif
          
    
    
    </tbody>
  </table>

 
@if (count($categories) == 0)
<div style="margin-left: 170px;" class="text-center bg-white shadow w-50  ">
    <h1>No Category Found</h1>
  </div>
@endif
</div>
</div>


  
@endsection