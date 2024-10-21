<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Men's Latest</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        @if ($products->count() > 0)
                            @foreach ($products as $product) 
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    @if ($product->images->isNotEmpty())
                                    <img src="{{ asset('images/seller_images/' . $product->images[0]->image) }}" alt="">
                                @else
                                    <img src="{{ asset('front-assets/images/default-image.jpg') }}" alt="Default Image"> <!-- Default image if no images -->
                                @endif
                            
                            </div>
                                <div class="down-content">
                                    <h4>{{$product->name}}</h4>
                                    <span>${{$product->price}}</span>
                                    <p>{{$product->description}}</p>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        @endif
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>