<section class="best-selling-products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                    <div class="text-end">
                        <span class="text-danger fw-bold">Must Have</span>
                        <h4>Best Selling Products</h4>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                    <div class="best-selling-products-slide">
                        @if(isset($best_selling) && !empty($best_selling))
                            @foreach($best_selling as $best) 
                                @if(isset($best) && !empty($best))
                                <div class="best-selling-box">
                                    <a href="{{ route('product_detail',['slug' => $best->slug]) }}">
                                        <img src="{{ URL::asset($best->image) ?? '' }}" alt="">
                                    </a>
                                </div>
                                @endif    
                            @endforeach
                        @endif    
                        
                        <!--<div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a5.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a1.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a5.jpg')}}" alt="">
                            </a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>