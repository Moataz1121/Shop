@extends('admin.master')
@section('subscriber_active', 'active')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="bg-white shadow-sm rounded">
    {{-- <a href="{{route('admin.category.create')}}" class="btn btn-primary m-3 w-25"> Add Category</a> --}}

@if (count($subscribers) > 0)
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Name</th>
        <th scope="col" class="text-center">Email</th>
        <th scope="col" class="text-center">Date OF Subcription</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($subscribers as $cat) 
        <tr>
            <th scope="row" class="text-center">{{$cat->id}}</th>
            <td class="text-center">{{$cat->name}}</td>
            <td class="text-center">{{$cat->email}}</td>
            <td class="text-center">{{$cat->created_at->diffForHumans()}}</td>
            <td class="text-center">
                  <form class="d-inline" action="{{route('subscriber.destroy', $cat->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  </form>
            </td>
            
          </tr>
        @endforeach
        @else
        <tr class="text-center">
            <td colspan="5" class="text-center p-4 text-danger">No Subscribers Found</td>
        </tr>

@endif
          
    
    
    </tbody>
  </table>

 
{{-- @if (count($subscribers) == 0)
<div style="margin-left: 170px;" class="text-center bg-white shadow w-50 p-5  ">
    <h1>No Subscriber Found</h1>
  </div>
@endif --}}
</div>
</div>
@endsection