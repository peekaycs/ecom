@extends('front.layouts.app')

@section('content')	
<section class="mt-4">
	<div class="container">			
        <div class="row">            
            <div class="col-md-8 col-sm-10 col-12">
                <div class="add-edit-address">
                    <form action="">
                        <div class="row">
                            @if(isset($addresses) && !empty($addresses))
                                @foreach($addresses as $address)
                                    @if(isset($address) && !empty($address))
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="mb-2">
                                            <span class="form-check float-start">
                                                <input type="radio" class="form-check-input" id="radio1" name="optradio" value="home" {{ (isset($address->default_address) && $address->default_address == 1) ? 'checked' : '' }}>
                                            </span>
                                            <div>
                                                <strong>{{ ucWords($address->address_type) ?? ''}}</strong>
                                                <span class="float-end"><i class="fas fa-ellipsis-v"></i></span>
                                            </div>
                                            <div class="px-4">{{ ucFirst($address->name) ?? ''}}<br>{{ $address->contact ?? ''}} <br>
                                            {{ isset($address->address) ? $address->address.',' : ''}} {{ isset($address->landmark) ? $address->landmark.',' : ''}} {{ isset($address->city) ? $address->city.',' : ''}}<br>{{ isset($address->state) ? $address->state.'-' : ''}} {{ isset($address->zip) ? $address->zip : ''}} <br> {{ isset($address->email) ? 'Email : '.$address->email : '' }}
                                            </div>
                                        </div>				
                                    </div>
                                    @endif
                                @endforeach
                            @endif        
                            <!--<div class="col-md-12 col-sm-12 col-12">
                                <div class="mb-2">
                                    <span class="form-check float-start">
                                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="home" checked>
                                    </span>
                                    <div>
                                        <strong>HOME</strong>
                                        <span class="float-end"><i class="fas fa-ellipsis-v"></i></span>
                                    </div>
                                    <div class="px-4">Ram kumar<br>8804444996 <br>
                                        2nd floor, Vipul Agora Building, near sahara mall, MG Road, Gurgaon,<br>
                                        Gurgaon, Haryana - 122002
                                    </div>
                                </div>				
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-6 text-center mb-2 mt-md-4 mt-sm-0">
                                <a href="javascript:void(0)" id="btn-add-new-address" class="btn btn-sm btn-outline-danger rounded-0 d-block">ADD NEW ADDRESS</a>
                            </div>
                            <div class="col-md-12 col-sm-12 col-6 text-center">
                                @if(isset($addresses) && $addresses->count() > 0)
                                    <a href="{{route('checkout')}}" class="btn btn-sm btn-success rounded-0 d-block">CONTINUE</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div id="add-new-address" class="add-edit-address">
                    <h5>Add Address/Edit Address</h5>
                    <form action="{{route('store')}}" method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                       			<div class="mb-2">
                                    <input type="text" name="name" class="form-control rounded-0" placeholder="Enter Your Name">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                 <input type="text" name="contact" class="form-control rounded-0" placeholder="Contact Number">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                 <input type="text" name="email" class="form-control rounded-0" placeholder="Email">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                    <input type="text" name="address" class="form-control rounded-0" placeholder="Enter address">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                    <input type="text" name="landmark" class="form-control rounded-0" placeholder="Landmark (optional)">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                    <input type="text" name="zip" class="form-control rounded-0" placeholder="Pin Number">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                    <input type="text" name="city" class="form-control rounded-0" placeholder="City">
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2">
                                    <input type="text" name="state" class="form-control rounded-0" placeholder="State">
                                </div>				
                            </div>
                            <div class="col-md-3 col-sm-3 col-4">
                                <div class="mb-2 mt-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="home" checked>Home
                                        <label class="form-check-label" for="radio1"></label>
                                    </div>
                                </div>				
                            </div>
                            <div class="col-md-3 col-sm-6 col-4">
                                <div class="mb-2 mt-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="office">Office
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                </div>				
                            </div>
                            <div class="col-md-3 col-sm-6 col-4">
                                <div class="mb-2 mt-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio3" name="optradio" value="other">Other
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>				
                            </div>
                        </div>
                        <div class="row"><hr>
                            <div class="col text-end">
                                <button type="button" class="btn btn-outline-danger rounded-0 btn-cancel">cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-success rounded-0">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php $total_discount = $total_price = $shipping = 0;?>
            @if( isset($cart_list) && !empty($cart_list) )
                @foreach($cart_list as $item_id => $item)
                    @foreach($item->conditions as $condition)
                        @if(isset($condition) && !empty($condition))
                            @if($condition->getType() == 'shipping')
                                <?php $shipping = $shipping + $condition->getValue(); ?>
                            @endif    
                        @endif        
                    @endforeach
                    <?php
                    $total_discount = $total_discount + ($item->price - $item->getPriceWithConditions()) * $item->quantity;
                    $total_price = $total_price + ($item->price * $item->quantity);
                    ?>
                @endforeach
            @endif 
            <?php 
            $ids = explode('_', $item_id);
            $product_id = $ids[0];
            $attribute_id = $ids[1] ?? '';?>

            <div class="col-md-4 col-sm-4 col-12 m-padding-lr">
                <div class="cart-section">
                    <h5 class="alert alert-info">Combo packs for this product</h5>
                    <div class="check-out">
                        <p>
                            MRP Total
                            <span>{{ $total_price ?? '' }}</span>
                        </p>									
                        <p>
                            {{ isset($total_discount) ? 'Price Discount' : ''}}
                            <span>{{ isset($total_discount) ? '-₹'. $total_discount : '0'}}</span>
                        </p>
                        <p>
                            {{ 'Shipping Charges' }} 
                            <span>{{ '+₹'.$shipping ?? '+₹0' }}</span>
                        </p>
                        <hr>
                        @if( isset($conditions) && !empty($conditions) )
                            @foreach($conditions as $key => $condition)
                            <p>
                                <strong>{{ $condition->getType() != null ? ucwords($condition->getType()) . ' Discount' : '' }} 
                                    <small style="color:red"><a href="javascript:void(0)" onclick="removeCoupon(this, '{{ $condition->getName() ?? ''}}')">Remove</a></small>
                                </strong>
                                <span><strong>Rs {{ $condition->getValue() ?? ''}}</strong></span>
                            </p>
                            @endforeach
                        @endif
                        <p>
                            <strong>To be paid</strong>
                            <span><strong>Rs {{ $subTotal ?? '' }}</strong></span>
                        </p>
                    </div>
                    <div class="alert alert-success">
                        <span>Total Savings: <strong>{{ isset($total_discount) ? '₹'. $total_discount : '0'}}</strong></span>
                        <!-- <button type="button" class="btn btn-sm btn-success float-end">CHECKOUT</button> -->
                        <a href="{{route('checkout')}}" class="btn btn-sm btn-success float-end">Payment</a>
                    </div>
                </div>                
            </div>            
        </div>
	</div>
</section>
@endsection