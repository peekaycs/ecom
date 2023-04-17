<section class="offer-section">
        <div class="container">
            <div class="row g-2">
                @if(isset($popular) && !empty($popular))
                    @foreach($popular->bannerImages as $banner)
                        @if(isset($banner) && !empty($banner))
                            @if( $loop->iteration == 2 )
                                <?php $cls = 'col-lg-3 col-md-3 col-sm-6';?>
                            @else
                                <?php $cls = 'col-lg-3 col-md-3 col-sm-6';?>
                            @endif
                            <div class="{{$cls}} col-md-3 col-md-3 col-6">
                                <div class="offer-box">
                                    <a href="javascript:void(0)">
                                        <img src="{{ URL::asset($banner->image) ?? ''}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif    
                    @endforeach
                @endif
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="offer-slide">
                        <div class="offer-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="offer-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="offer-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="offer-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>