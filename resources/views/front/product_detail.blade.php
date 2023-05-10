@extends('front.layouts.app')

@section('content')		
<section class="mt-4">
	<div class="container">		
        <form action="{{route('AddToCart')}}" method="POST" >	
            <input type="hidden" name="id" value="{{ $product->id ?? '0' }}" class="id" id="id">
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
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-5 col-12">
                    <div class="product-name">
                        @if( isset($product) && !empty($product) )
                        <h4>{{ $product->product ?? '' }} {{ isset($product->productAttribute[0]->attribute->name) ? '('.$product->productAttribute[0]->attribute->name.')' : '' }} </h4>
                        <h5>{{ $product->short_description ?? '' }}</h5>
                        <h5>SKU: {{ $product->sku ?? '' }}</h5>
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
                                        <input type="hidden" name="variant_id" value="" class="variant_id" id="variant_id">
                                        @foreach($product->productAttribute as $productAttribute)
                                        <a href="javascript:void(0)" onClick="selectVariant(this,{{ $loop->iteration }})" class=" variant {{ ($loop->iteration == 1) ? 'active' : '' }} variant_{{ $loop->iteration }}">
                                            <span class="variant_name_{{ $loop->iteration }}" data-name="{{ $productAttribute->attribute->name ?? '' }}" data-id="{{ $productAttribute->id ?? '' }}">{{ $productAttribute->attribute->name ?? '' }}</span>
                                            <small class="variant_price_{{ $loop->iteration }}" data-price="{{ $productAttribute->price ?? ''}}" data-discount="{{ $productAttribute->discount ?? '' }}">Rs {{ $productAttribute->price ?? ''}}</small>
                                        </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
        
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="product-price">
                        <h4>Rs <span class="priceAdd">{{ isset($product->price) ? $product->price - ($product->price * $product->discount)/100 : '' }} <span></h4>                    
                        <div class="quantity">
                            <span>
                                <select name="quantity" id="quantity" class="quantity">
                                    <?php
                                    for($i = 1; $i <= 10; $i++){
                                        echo '<option value=" '.$i.' "> '.$i.' </option>';
                                    }
                                    ?>
                                </select>
                            </span>
                            <span class="sizeAdd"></span>                        
                        </div>
                        <br>
                        @if(Auth::check())
                        <button type="submit" name="submit" value="buyNow" class="btn btn-sm btn-success">Buy Now</button>
                        <button type="submit" name="submit" value="addToCart" class="btn btn-sm btn-success">Add to cart</button>
                        @else
                        <button type="button" name="submit" class="btn btn-sm btn-success" onclick="document.getElementById('login').style.display='block'">Buy Now</button>
                        <button type="button" name="submit" class="btn btn-sm btn-success" onclick="document.getElementById('login').style.display='block'">Add to cart</button>
                        @endif
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
                    {!! $product->productDetail->description ?? 'N/A' !!}                  
                </div>
                <h5>Frequently Asked Questions (FAQs)</h5>
                <div class="productFAQ">
                    <div class="product-faq-inner">
                        {{ $product->faq ?? 'N/A' }}  
                    </div>    
                </div>
                <div class="clear border-one"></div>  
                @endif
            </div>

            <div class="col-md-4 col-sm-4 col-12">
                <div class="similar-product right-sticky">
                    <h5>Similar Product</h5>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if (isset($similer_product) && !empty($similer_product))
                            @foreach($similer_product as $product)
                                @if (isset($product) && !empty($product))
                                <div class="additional-discount">
                                    <div class="ad-img">
                                        <p>{{ $product->product ?? ''}} {{ (isset($c->productAttribute[0])) ? ' - '.$product->productAttribute[0]->attribute->name : '' }}</p>
                                        <img src="{{ URL::asset($product->image) ?? '' }}" alt="">
                                    </div>
                                    <div class="ad-price">
                                        <?php $price = $product->price - (($product->price * $product->discount) / 100); ?>                                  
                                        <h5>Rs {{ $price ?? 0 }}</h5>
                                        <h6>
                                            <span class="mrp">MRP {{ $product->price ?? 0 }}</span>
                                            <span class="off">{{ $product->discount ?? 0 }}% OFF</span>							
                                        </h6>
                                        <a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $product->slug)]) }}" class="btn btn-sm btn-primary">BUY NOW</a>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
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
    function selectVariant(thiss,iteration){
        $(".variant").removeClass('active');
        $(".variant").css('border','none');
        $(".variant_" + iteration).addClass('active');
        $(".variant_" + iteration).css('border','2px solid black');
    
        var name = $(".variant_name_" + iteration).data("name");
        var id = $(".variant_name_" + iteration).data("id");
        var price = $(".variant_price_" + iteration).data("price");
        var discount = $(".variant_price_" + iteration).data("discount");

        $(".priceAdd").html(price);
        $(".sizeAdd").html('of ' + name);
        $(".variant_id").val(id);
        $(".price").val(price);
        $(".discount").val(discount);
    }
</script>
@endsection	
