@extends('front.layouts.app')

@section('content')		
<section class="mt-4">
	<div class="container">		
        <form action="{{route('AddToCart')}}" method="POST" >	
            <input type="hidden" name="slug" value="{{ $product->slug ?? '' }}" >
            @csrf
            <div class="row mb-3">
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="product-detail">
                        <div class="tab-section">                        
                            <div class="tab-content">
                                @if( isset($product) && !empty($product) )
                                    @foreach( $product->productImage as $image)
                                        @if( isset($image) && !empty($image) )
                                        <div id="img{{$loop->iteration}}" class="tab-pane {{ ($loop->iteration == 1) ? 'active' : 'fade' }}">
                                            <img src="{{ URL::asset($image->image) ?? '' }}" alt="">
                                        </div>
                                        @endif
                                    @endforeach
                                @endif        
                                <!--<div id="img2" class="tab-pane fade">
                                    <img src="images/b2.jpg" alt="">
                                </div>
                                <div id="img3" class="tab-pane fade">
                                    <img src="images/b3.jpg" alt="">
                                </div>
                                <div id="img4" class="tab-pane fade">
                                    <img src="images/b4.jpg" alt="">
                                </div>
                                <div id="img5" class="tab-pane fade">
                                    <img src="images/b3.jpg" alt="">
                                </div>-->
                            </div>
                            <ul class="nav nav-tabs">
                                @if( isset($product) && !empty($product) )
                                    @foreach( $product->productImage as $image)
                                        @if( isset($image) && !empty($image) )
                                        <li class="nav-item">
                                            <a class="nav-link {{ ($loop->iteration == 1) ? 'active' : '' }}" data-bs-toggle="tab" href="#img{{$loop->iteration}}">
                                                <img src="{{ URL::asset($image->image) ?? '' }}" alt="">
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                @endif
                                <!--<li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#img1">
                                        <img src="images/b1.jpg" alt="">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#img2">
                                        <img src="images/b2.jpg" alt="">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#img3">
                                        <img src="images/b3.jpg" alt="">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#img4">
                                        <img src="images/b4.jpg" alt="">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#img5">
                                        <img src="images/b3.jpg" alt="">
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-5 col-12">
                    <div class="product-name">
                        @if( isset($product) && !empty($product) )
                        <h4>{{ $product->product ?? '' }} ( {{ isset($product->productAttribute[0]) ? $product->productAttribute[0]->attribute->name : '' }} )</h4>
                        <h5>{{ $product->short_description ?? '' }}</h5>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="additional-discount">
                                <div class="ad-price">
                                    <h5>Rs {{$product->price - ($product->price * $product->discount)/100 }}</h5>
                                    <h6>
                                        <span class="mrp">MRP {{ $product->price ?? '' }}</span>
                                        <span class="off">{{ $product->discount ?? '' }}% OFF</span>							
                                    </h6>
                                </div>
                            </div>
                            <div class="size">
                                <p>{{ isset($product->productAttribute[0]) ? ' Select from available '. $product->productAttribute[0]->attributeGroup->name .':' : '' }} </p>
                                <div class="size-group">
                                    @if( isset($product->productAttribute) && !empty($product->productAttribute) )
                                        @foreach($product->productAttribute as $productAttribute)
                                        <a href="javascript:void(0)" onClick="selectVariant(this,{{ $loop->iteration }})" class=" variant {{ ($loop->iteration == 1) ? 'active' : '' }} variant_{{ $loop->iteration }}">
                                            <span class="variant_name_{{ $loop->iteration }}" data-name="{{ $productAttribute->attribute->name ?? '' }}">{{ $productAttribute->attribute->name ?? '' }}</span>
                                            <small class="variant_price_{{ $loop->iteration }}" data-price="{{ $productAttribute->price ?? ''}}">Rs {{ $productAttribute->price ?? ''}}</small>
                                        </a>
                                        @endforeach
                                    @endif
                                    <!--<a href="javascript:void(0)">
                                        3x30ml
                                        <small>rs 885</small>
                                    </a>
                                    
                                    <a href="javascript:void(0)">
                                        5x30ml
                                        <small>rs 14266</small>
                                    </a>-->
                                </div>
                            </div>
                            <!--<div class="delivery-pin">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Enter Delivery Pincode">
                                        <span class="input-group-text">Check</span>
                                    </div>
                                    <p>
                                        <span> Delivery by18 Mar, Saturday</span> 
                                        | Free <span>₹40</span>
                                    </p>
                                </form>
                            </div>-->
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-12">
                    <div class="product-price">
                        <h4>Rs <span class="priceAdd">{{ isset($product->price) ? $product->price - ($product->price * $product->discount)/100 : '' }} <span></h4>                    
                        <div class="quantity">
                            <span>
                                <select>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </span>
                            <span class="sizeAdd"></span>                        
                        </div>
                        <!--<a href="{{-- route('cart_list') --}}" class="btn btn-sm btn-primary">Buy Now</a>-->
                        <br>
                        <button type="submit" name="submit" class="btn btn-sm btn-success">Buy Now</button>
                        <button type="submit" name="submit" class="btn btn-sm btn-success">Add to cart</button>
                    </div>                
                </div>
            </div>
        </form>
	</div>
</section>
<section class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-12">
                @if( isset($product) && !empty($product) )
                <h5>Description</h5>
                <div class="product-overview">  
                    {{ $product->description ?? 'N/A' }}                  
                    <!--<h6>Also known as</h6>
					<p>Syzygium jamb</p>
					<h6>Properties</h6>					
					<ul>
						<li>Potency</li>
						<li>1X (Q)</li>
					</ul>
					<ul>
						<li>Weight</li>
						<li>75 (gms)</li>
					</ul>
					<ul>
						<li>Dimensions</li>
						<li>3 (cm) x 3 (cm) x 9.4 (cm)</li>
					</ul>
					<h6>About Willmar Schwabe Syzygium Jambolinum 1x (Mother Tincture)</h6>
					<p>Common Name:  Jambol seeds</p><br>
					<h6>Causes & Symptoms for Willmar Schwabe Syzygium Jambolinum 1x (Mother Tincture)</h6>
					<p>Syzygium is a native of India and has effective results in Increased Blood sugar levels. </p>
					<p>Syzygium is a native of India and has effective results in Increased Blood sugar levels. </p>
					<p>Syzygium is a native of India and has effective results in Increased Blood sugar levels. </p>-->
                </div>
                <h5>Frequently Asked Questions (FAQs)</h5>
                <div class="productFAQ">
                    <div class="product-faq-inner">
                        {{ $product->faq ?? 'N/A' }}  
                    </div>    
                    <!--<div class="product-faq-inner">
                        <div class="question-icon">Q</div>
                        <div class="question-answer">
                            <p class="question">How many days do I need to use R 89 (Lipocol) medicine to see effective results?</p>
                            <p class="answer">Depending upon the symptoms we can decide the duration of the medicines. For better results you can take the medicines minimum for 1 to 2 months.</p>
                        </div>
                    </div>
                    <div class="product-faq-inner">
                        <div class="question-icon">Q</div>
                        <div class="question-answer">
                            <p class="question">How many days do I need to use R 89 (Lipocol) medicine to see effective results?</p>
                            <p class="answer">Depending upon the symptoms we can decide the duration of the medicines. For better results you can take the medicines minimum for 1 to 2 months.</p>
                        </div>
                    </div>-->
                </div>
                <div class="clear border-one"></div>  
                @endif
            </div>

            <div class="col-md-4 col-sm-4 col-12">
                <div class="similar-product right-sticky">
                    <h5>Similar Product</h5>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="additional-discount">
                            <div class="ad-img">
                                <p>Pack of 2</p>
                                <img src="{{URL::asset('assets/front/images/b2.jpg')}}" alt="">
                            </div>
                            <div class="ad-price">
                                <h5>Rs 275</h5>
                                <h6>
                                    <span class="mrp">MRP 200</span>
                                    <span class="off">17% OFF</span>							
                                </h6>
                                <a href="#" class="btn btn-sm btn-primary">BUY NOW</a>
                            </div>
                        </div>
                        <div class="additional-discount">
                            <div class="ad-img">
                                <p>Pack of 2</p>
                                <img src="{{URL::asset('assets/front/images/b2.jpg')}}" alt="">
                            </div>
                            <div class="ad-price">
                                <h5>Rs 275</h5>
                                <h6>
                                    <span class="mrp">MRP 200</span>
                                    <span class="off">17% OFF</span>							
                                </h6>
                                <a href="#" class="btn btn-sm btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</section>
@include('front.include.popular_health_product') 

@endsection		

@section('script')	
<script>
    $( document ).ready(function() {
        /*$(".variant").each(function(i, obj){
            var has_class = $(obj).hasClass('active');
            if(has_class == true){
                var k = i+1;
                var name = $(".variant_name_" + k ).data("name");
                var price = $(".variant_price_" + k ).data("price");
                $(".priceAdd").html(price);
                $(".sizeAdd").html(name);
            }
        });*/
    });
    function selectVariant(thiss,iteration){
        $(".variant").removeClass('active');
        $(".variant").css('border','none');
        $(".variant_" + iteration).addClass('active');
        $(".variant_" + iteration).css('border','2px solid black');
    
        var name = $(".variant_name_" + iteration).data("name");
        var price = $(".variant_price_" + iteration).data("price");
        $(".priceAdd").html(price);
        $(".sizeAdd").html('of ' + name);
    }
</script>
@endsection	
