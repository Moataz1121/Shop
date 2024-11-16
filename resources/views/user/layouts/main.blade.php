<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>We Are Hexashop</h4>
                            <span>Awesome, clean &amp; creative HTML5 Template</span>
                            <div class="main-border-button">
                                <a href="#">Purchase Now!</a>
                            </div>
                        </div>
                        <img src="{{asset('front-assets')}}/images/left-banner-image.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        {{-- @dd($categories) --}}
                        @if ($categories->count() > 0)
                            @foreach ($categories as $category) 
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>{{$category->name}}</h4>
                                            <span>Best Clothes For {{$category->name}}</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>{{$category->name}}</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                                <div class="main-border-button">
                                                    <a href="{{route('product.index')}}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset('front-assets')}}/images/baner-right-image-01.jpg">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>