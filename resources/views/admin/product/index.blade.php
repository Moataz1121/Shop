@extends('admin.master')

@section('product_active', 'active')
@section('content')
<div class="bg-white shadow-sm rounded m-3">
    <form method="GET" action="{{ route('admin.getProducts') }}" class="mb-3">
        <div class="form-row">
            <div class="col">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </div>
    </form>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Price</th>
            <th scope="col" class="text-center">Date OF Creation</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
            @if (count($products) == 0)
                <tr class="text-center">
                    <td colspan="5" class="text-center p-4 text-danger">No Products Found</td>
                </tr>
            @endif
            @foreach ($products as $cat) 
            <tr>
                <th scope="row" class="text-center">{{$cat->id}}</th>
                <td class="text-center">{{$cat->name}}</td>
                <td class="text-center">{{$cat->price}}</td>
                <td class="text-center">{{$cat->created_at->diffForHumans()}}</td>
                <td class="text-center">
                    <a href="{{route('admin.getProductDetails', $cat->id)}}" class="btn btn-warning">More...</a>
                </td>
              </tr>
            @endforeach       
        </tbody>
      </table>    
</div>


@endsection