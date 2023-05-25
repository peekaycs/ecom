@extends('front.layouts.app')

@section('content')			
<section class="mt-4">
	<div class="container">	
        @if(isset($cart_list) && count($cart_list))		
		<div class="row mb-3">
            <div class="col-md-8 col-sm-8 col-12">
                <div class="cart-section">
                    <h5>Items NOT Requiring Prescription (1)</h5>
                    <div class="col-md-12 col-sm-12 col-12">
                        <?php $total_discount = $total_price = $shipping = $coupon_discount = 0;?>
                        @if( isset($cart_list) && !empty($cart_list) )
                            @foreach($cart_list as $item_id => $item)
                            <?php 
                            
                            $ids = explode('_', $item_id);
                            $product_id = $ids[0];
                            $attribute_id = $ids[1] ?? '';
                            if(isset($attribute_id) && !empty($attribute_id)){
                                $image = URL::asset($product[$product_id]['image']);
                                foreach($attribute as $attr){
                                    $attrs = $attr->attribute->name;
                                }
                            }else{
                                $image = URL::asset($product[$product_id]['image']);
                                $attrs = '';
                            }
                            
                            ?>
                            <div class="cart-price">
                                <figure>
                                    <img src="{{ $image ?? '' }}" alt="">
                                </figure>
                                <div class="cart-data">
                                    <p>{{ $item->name ?? '' }}</p>
                                    <p><small>{{ $attrs ?? '' }}</small></p>
                                    <p>
                                        <a href="javascript:void(0)" class="removeItem" data-product_id={{ $item->id ?? '' }}> 
                                            <i class="fa fa-trash" aria-hidden="true"></i>Remove
                                        </a>
                                    </p>
                                </div>	
                                <?php 
                                foreach($item->conditions as $condition){
                                    if(isset($condition) && !empty($condition)){
                                        
                                        if($condition->getType() == 'price'){
                                            $discount = $condition->getValue();
                                            $total_discount = $total_discount + ( ( $item->price * abs((int)rtrim($discount,'%')) ) / 100 ) * $item->quantity;
                                        }
                                        /*if($condition->getType() == 'shipping'){
                                            $shipping_cost = $condition->getValue();
                                            $shipping = $shipping + $condition->getValue() * $item->quantity;
                                        }*/   
                                    }        
                                }
                                $total_price = $total_price + ($item->price * $item->quantity);
                                //$total_price_without_shipping = ($item->getPriceWithConditions() - $shipping_cost) * $item->quantity;
                                $total_price_without_shipping = ($item->getPriceWithConditions()) * $item->quantity;
                                ?>
                                <div class="cart-data product-plus-minus">
                                    <p>₹{{ $total_price_without_shipping ?? '0' }} </p>
                                    <p><small>MRP <span class="mrp">₹{{ $item->price ?? '0' }}</span>{{ $discount }}</small></p>
                                    <p>
                                        <i class="fa fa-minus-circle changeQty changeQty_{{ $item->id ?? '' }} minus" aria-hidden="true" data-quantity_{{ $item->id ?? '' }}={{ $item->quantity ?? '' }} data-product_id={{ $item->id ?? '' }}></i>
                                        <span class="quantity quantity_{{ $item->id ?? '' }}">{{ $item->quantity ?? '' }}</span>
                                        <i class="fa fa-plus-circle changeQty changeQty_{{ $item->id ?? '' }} plus" aria-hidden="true" data-quantity_{{ $item->id ?? '' }}={{ $item->quantity ?? '' }} data-product_id={{ $item->id ?? '' }}></i>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        @endif        							
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-12 m-padding-lr">
                <div class="cart-section">
                    <h5 class="alert-info">Combo packs for this product</h5>
                    <div class="check-out">
                        <p>
                            MRP Total
                            <span>{{ $total_price ?? '' }}</span>
                        </p>									
                        <p>
                            {{ isset($total_discount) ? 'Price Discount' : ''}}
                            <span>{{ isset($total_discount) ? '-'. $total_discount : '-0'}}</span>
                        </p>
                        <!--<p>
                            {{ 'Shipping Charges' }} 
                            <span>{{ '+₹'.$shipping ?? '+₹0' }}</span>
                        </p>
                        <hr>-->
                        @if( isset($conditions) && !empty($conditions) )
                            @foreach($conditions as $key => $condition)
                            <?php
                            $type = $condition->getType() ?? '';
                            if( isset( $type ) && $type == 'shipping' ){
                                $shipping = $condition->getValue();
                                ?>
                                <p>
                                    {{ 'Shipping Charges' }} 
                                    <span>{{ $condition->getValue() ?? '+0' }}</span>
                                </p>
                                <hr>
                                <?php
                            }elseif( isset( $type ) && $type == 'coupon' ){
                                $string = $condition->getValue();
                                if(strpos($string, '%')){
                                    $coupon_discount = ( ( $total_price + $shipping - $total_discount) * abs( ( int )rtrim( $string, '%' ) ) ) / 100;
                                }else{
                                    $coupon_discount = ( $total_price + $shipping - $total_discount) - abs( ( int )rtrim( $string, '%' ) );
                                }
                                ?>
                                <p>
                                    <strong>{{ $condition->getType() != null ? ucwords($condition->getType()) . ' Discount' : '' }} 
                                        <small style="color:red"><a href="javascript:void(0)" onclick="removeCoupon(this, '{{ $condition->getName() ?? ''}}')">Remove</a></small>
                                    </strong>
                                    <span><strong>₹{{ $condition->getValue() ?? '+0' }}</strong></span>
                                </p>
                                <?php
                            }
                            ?>    
                            @endforeach
                        @endif    
                        <p class="coupons-apply">
                            <strong>
                                <input type="text" name="coupon" class="coupon" id="coupon" placeholder="Coupon Code eg. 12345">
                                <strong class="btn btn-sm btn-success" onclick="applyCoupon(this)" data-apply="1">Apply</strong>
                            </strong>
                            <span><strong></strong></span>
                        </p>
                        <hr>
                        <p>
                            <strong>To be paid</strong>
                            <span><strong>₹{{ $subTotal ?? '' }}</strong></span>
                        </p>
                    </div>
                    <!-- <div class="coupons-apply">
                        <p>Apply Coupon</p>
                        <input type="text" class="form-control-sm">
                    </div> -->
                    <form action="{{route('order')}}" method="POST" >	
                        @csrf
                        <input type="hidden" name="applied_coupon" value="12345" class="name" id="name">
                        <input type="hidden" name="total" value="{{ $total_price ?? '' }}" class="price" id="price">
                        <input type="hidden" name="discount" value="{{ $total_discount ?? '0' }}" class="discount" id="discount">
                    
                        <div class="alert-success p-md-3 p-2">
                            <span>Total Savings: <strong>{{ isset( $total_discount ) ? '₹'. ( ceil( $total_discount ) + $coupon_discount ) : '0' }}</strong></span>
                            <button type="submit" name="submit" class="btn btn-sm btn-success float-end">CHECKOUT</button>
                        </div>
                    </form>
                </div>                
            </div> 
        </div>
        @else
        <div class="row mb-3">
            <h2>Your cart is empty.</h2>
        </div>
        @endif
	</div>
</section>
<!--<section class="slide-section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h4 class="heading">Popular Healthcare Products</h4>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="product-slide">
                    <div class="product-box">
                        <span class="product-offer">-16%</span>
                        <a href="javascript:void(0)" class="text-center">
                            <img src="images/b1.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li class="str-color"><i class="fas fa-star"></i></li>
                            <li class="str-color"><i class="fas fa-star"></i></li>
                            <li class="str-color"><i class="fas fa-star"></i></li>
                            <li class="str-color"><i class="fas fa-star"></i></li>
                            <li class="str-color"><i class="fas fa-star-half-alt"></i></li>
                            <li><small class="px-1">1 review(2)</small></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-box">
                        <a href="javascript:void(0)" class="text-center">
                            <img src="images/b2.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-box">
                        <a href="javascript:void(0)" class="text-center">
                            <img src="images/b3.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-box">
                        <a href="javascript:void(0)" class="text-center">
                            <img src="images/b4.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-box">
                        <a href="javascript:void(0)" class="text-center">
                            <img src="images/b5.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>
                    <div class="product-box">
                        <a href="javascript:void(0)">
                            <img src="images/b3.jpg" alt="">
                        </a>
                        <div class="categories-name">
                            <a href="javascript:void(0)">Personal Care</a>
                            <a href="javascript:void(0)">Stomach Pain</a>
                        </div>
                        <a href="javascript:void(0)">
                            <h5 class="product-name">Essential Oil Blends – 10mL</h5>
                        </a>
                        <p class="item-price">                                    
                            <ins>$255,00</ins>
                            <del>$240,00</del>
                        </p>
                        <ul class="star-rating">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <div class="add-to-cart">
                            <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</section>-->
@include('front.include.popular_health_product') 
@endsection	

@section('script')	
<script>

    $('.changeQty').click(function(e){ 
        var msg = '';
        var quantity = 0;
        
        var product_id = $(this).data("product_id");
        var qty = $(this).data('quantity_' + product_id);
        if($(this).hasClass('minus') == true){
            if( qty > 1){
                qty = qty-1;
                quantity = -1;
                msg = 'Quantity Removed.';
            }else{
                alert('Minimum quantity is 1.')
                exit;
            }
        }else{
            qty = qty+1;
            quantity = 1;
            msg ='Quantity Increased.';
        }
        $('.changeQty_' + product_id).data('quantity', qty);
        $('.quantity_' + product_id).html(qty);
        $.ajax({
            type: 'POST',
            url: "{{ url('update-cart') }}",
            data: { _token: "{{ csrf_token() }}", quantity : quantity, product_id : product_id },
            success: function(response) { 
                alert(msg);
                location.reload(); 
            }
        });
    });

    $('.removeItem').click(function(e){ 
        var product_id = $(this).data("product_id");
        $.ajax({
            type: 'POST',
            url: "{{ url('remove-from-cart') }}",
            data: { _token: "{{ csrf_token() }}", product_id : product_id },
            success: function(response) { 
                alert("Item Removed.") 
                location.reload();
            }
        });
    });

    function applyCoupon(thiss){
        var code = $(".coupon").val();
        if(code != '' && code != 'undefined' && code != null){
            $.ajax({
                type: 'POST',
                url: "{{ url('apply-coupon') }}",
                data: { _token: "{{ csrf_token() }}", code : code },
                success: function(response) { 
                    console.log(response);
                    if(response == 1){
                        alert("Coupon Applied."); 
                        //$(".couponPara").show();
                        location.reload();
                    }else if(response == 2){
                        alert("You can not apply two coupon.");
                    }else{
                        alert("Invalid Coupon Code."); 
                    }
                }
            });
        }else{
            alert("Invalid Coupon Code.") 
        }    
    }
    function removeCoupon(thiss, name){
        if(name != '' && name != 'undefined' && name != null){
            $.ajax({
                type: 'POST',
                url: "{{ url('remove-coupon') }}",
                data: { _token: "{{ csrf_token() }}", couponName : name },
                success: function(response) { 
                    console.log(response);
                    if(response == 1){
                        alert("Coupon Removed."); 
                        //$(".couponPara").hide();
                        location.reload();
                    }else{
                        alert(123);
                        alert("Invalid Coupon Code.");
                    }
                }
            });
        }else{
            alert("Invalid Coupon Code.") 
        }    
    }

</script>
@endsection	
