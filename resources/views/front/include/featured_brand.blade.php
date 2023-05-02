<section class="slide-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Featured Brands</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="featured-brand-slide">
                        @if (isset($featured) && !empty($featured))
                            @foreach($featured->bannerImages as $banner)
                                @if(isset($banner) && !empty($banner))
                                <div class="product-box featured-product-box">
                                    <a href="{{ $banner->link ?? 'javascript:void(0)' }}" class="text-center">
                                        <span class="zoomimg">
                                            <img src="{{ URL::asset($banner->image) ?? '' }}" alt="" class="circle">
                                        </span>
                                    </a>
                                    <a href="{{ $banner->link ?? 'javascript:void(0)' }}" class="text-center">
                                        <h5 class="product-name">{{ $featured->name ?? '' }}</h5>
                                        <span class="offer-btn">up to 50% off</span>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        <!--<div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p2.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p3.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p4.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)"  class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p5.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p2.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p4.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>	-->
                    </div>
                </div>
            </div>
        </div>
    </section>