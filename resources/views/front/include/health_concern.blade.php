<section class="product-cat-section mt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Shop by Health Concerns</h4>
                </div>
            </div>
            <div class="row mt-3">
                @if (isset($bottom) && !empty($bottom))
                    @foreach($bottom as $banner)
                    <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="product-cat-box">
                            <div class="product-cat-image">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::asset($banner->bannerImages[0]->image)}}" alt="">
                                </a>
                            </div>
                            <div class="product-cat-details">
                                <h4><a href="javascript:void(0)">{{$banner->name}}</a></h4>
                                <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                            </div>                    
                        </div>
                    </div>
                    @endforeach
                @endif    
                <!--<div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Hair Loss</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Magraine & Headache</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Stomach Pain</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>    -->        
            </div>
        </div>
    </section>