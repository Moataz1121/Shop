@extends('seller.master')

@section('content')
<div class="container">
    <h1>Bookings</h1>

    @if ($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Seller Name</th>
                    <th>Booking Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->product->name ?? 'N/A' }}</td>
                        <td>{{ $booking->seller->name ?? 'N/A' }}</td>
                        
                        <td>{{ $booking->booked_at ?? 'n/a' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection