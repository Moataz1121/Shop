<!DOCTYPE html>
<html lang="en">
@include('seller.layouts.head')
<body>
    <div class="container" style="margin-top: 50px">
        <form method="POST" action="{{ route('seller.logins') }}"  >
           @csrf
             
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      @error('email')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                      </div>
                      @error('password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
               
                   
            
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         
       
            
          
          </form>
          <a href="{{ route('google.login', ['type' => 'seller']) }}" class="btn btn-primary">
            Login with Google (Seller)
        </a>
    </div>
    
    
</body>
</html>