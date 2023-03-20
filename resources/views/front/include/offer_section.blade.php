<section class="offer-section">
        <div class="container">
            <div class="row">
                @if(isset($popular) && !empty($popular))
                    @foreach($popular as $banner)
                        @if(isset($banner) && !empty($banner))
                            @if( $loop->iteration == 2 )
                                <?php $cls = 'col-lg-6 col-md-6 col-sm-6';?>
                            @else
                                <?php $cls = 'col-lg-3 col-md-3 col-sm-3';?>
                            @endif
                            <div class="{{$cls}} col-12">
                                <div class="offer-box">
                                    <a href="javascript:void(0)">
                                        <img src="{{ URL::asset($banner->bannerImages[0]->image) ?? ''}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif    
                    @endforeach
                @endif
                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="offer-box">
                        <a href="javascript:void(0)">
                            <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="offer-box">
                        <a href="javascript:void(0)">
                            <img src="{{URL::asset('assets/front/images/offer3.jpg')}}" alt="">
                        </a>
                    </div>
                </div>-->
            </div>
        </div>
    </section>