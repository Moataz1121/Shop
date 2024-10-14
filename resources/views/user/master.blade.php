<!DOCTYPE html>
<html lang="en">

@include('user.layouts.head')
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    @include('user.layouts.nav')
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    @include('user.layouts.main')
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    @include('user.layouts.men')
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    @include('user.layouts.women')
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    @include('user.layouts.kids')
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Explore Area Starts ***** -->
    @include('user.layouts.explore')
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    @include('user.layouts.social')
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    @include('user.layouts.subscribe')
    <!-- ***** Subscribe Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    @include('user.layouts.footer')
    

    <!-- jQuery -->
   @include('user.layouts.scripts')

  </body>
</html>