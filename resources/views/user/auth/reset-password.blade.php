<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
@section('title', 'Reset Password')
<body>
    @include('user.layouts.nav')
    <div class="container" style="margin-top: 150px">
        <form method="POST" action="{{ route('password.store') }}" >
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
           
            <p class="text-center">Now set your new password</p>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
               <input type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control" id="email">
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">Password</label> 
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div>
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
           
          
          </form>
    </div>
</body>
</html>