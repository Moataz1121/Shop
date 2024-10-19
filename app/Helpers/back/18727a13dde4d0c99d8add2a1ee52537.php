<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('user.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<head>
<title>Login</title>
</head>
<body>
    <?php echo $__env->make('user.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container" style="margin-top: 150px">
        <form method="POST" action="<?php echo e(route('login')); ?>" >
            <?php echo csrf_field(); ?>
            <div class="row shadow p-3">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input value="<?php echo e(old('email')); ?>" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                      </div>
                </div>
             <a href="<?php echo e(route('password.request')); ?>" class="me-2">Forget Password</a>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         
            <a href="<?php echo e(route('google.login', ['type' => 'user'])); ?>" class="btn btn-primary">
                Login with Google (User)
            </a>
            
            
          
          </form>
    </div>
  

</body>
</html><?php /**PATH /mnt/01D95E513BD88DB0/My project/laravel/Afer ITI/ecommerce/resources/views/user/auth/login.blade.php ENDPATH**/ ?>