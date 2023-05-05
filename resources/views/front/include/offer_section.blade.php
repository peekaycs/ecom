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
                                    <a href="{{ $banner->link ?? 'javascript:void(0)' }}">
                                        <img src="{{ URL::asset($banner->image) ?? ''}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif    
                    @endforeach
                @endif
            </div>
        </div>
    </section>