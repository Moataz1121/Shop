<!DOCTYPE html>
<html lang="en">
@include('seller.layouts.head')
<body>
    <div class="container" style="margin-top: 50px">
        <form method="POST" action="{{ route('seller.register') }}" enctype="multipart/form-data" >
           @csrf
            <div class="row shadow p-3">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label">Name</label>
                        <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="emailHelp">
                      </div>
                      @error('name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
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
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
                      </div>
                      @error('password_confirmation')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label">Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputname" aria-describedby="emailHelp">
                      </div>
                      @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label d-block">gender</label>
                        <select class="form-control" name="gender" id="">
                            <option value="male" class="form-control">Male</option>
                            <option value="female" class="form-control">Female</option>
                        </select>
                      </div>
                      @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                     
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby="emailHelp">
                      </div>
                      @error('image')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                <div class="col-lg-12">
                   
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         
           
          
          </form>
    </div>
    
    
</body>
</html>