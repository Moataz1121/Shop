<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
<title>Login</title>
<body>
    @include('user.layouts.nav')

    <div class="container" style="margin-top: 150px">
        <form method="POST" action="{{ route('login') }}" >
            @csrf
            <div class="row shadow p-3">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                      </div>
                </div>
             
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         
           
          
          </form>
    </div>
  

</body>
</html>