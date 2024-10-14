<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
<body>
    @include('user.layouts.nav')

    <div class="container" style="margin-top: 150px">
        <form method="POST" action="{{ route('password.email') }}" >
            @csrf
           
            <p class="text-center">If you forgot your password set your email and we will send you a password reset link</p>
            <div>
                <label for="email" class="form-label">Email</label>
               <input type="email" name="email" class="form-control" id="email">
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
           
          
          </form>
    </div>
  
</body>
</html>