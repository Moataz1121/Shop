<!DOCTYPE html>
<html lang="en">
@include('seller.layouts.head')
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('seller.layouts.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel">
       @include('seller.layouts.nav')

        <div class="container">
          @yield('content')
        </div>

       @include('seller.layouts.footer')
      </div>

      <!-- Custom template | don't include it in your project! -->
      @include('seller.layouts.settings')
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
   @include('seller.layouts.scripts')
  </body>
</html>
