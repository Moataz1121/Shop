<script src="{{asset('front-assets')}}/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="{{asset('front-assets')}}/js/popper.js"></script>
<script src="{{asset('front-assets')}}/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="{{asset('front-assets')}}/js/owl-carousel.js"></script>
<script src="{{asset('front-assets')}}/js/accordions.js"></script>
<script src="{{asset('front-assets')}}/js/datepicker.js"></script>
<script src="{{asset('front-assets')}}/js/scrollreveal.min.js"></script>
<script src="{{asset('front-assets')}}/js/waypoints.min.js"></script>
<script src="{{asset('front-assets')}}/js/jquery.counterup.min.js"></script>
<script src="{{asset('front-assets')}}/js/imgfix.min.js"></script> 
<script src="{{asset('front-assets')}}/js/slick.js"></script> 
<script src="{{asset('front-assets')}}/js/lightbox.js"></script> 
<script src="{{asset('front-assets')}}/js/isotope.js"></script> 

<!-- Global Init -->
<script src="{{asset('front-assets')}}/js/custom.js"></script>

<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
        selectedClass = $(this).attr("data-rel");
        $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
        setTimeout(function() {
          $("."+selectedClass).fadeIn();
          $("#portfolio").fadeTo(50, 1);
        }, 500);
            
        });
    });

</script>