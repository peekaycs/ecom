@extends('front.layouts.app')
@section('content')
<div class="dashboard">			
	<div class="account-aside">
		<div class="aside-profile">
			<span><img src="{{ URL::asset('assets/front/images/login_icon.png') }}" alt=""></span>
			<div class="persional-details">
				<h6>{{ $user->fullname ?? ''}}</h6>
				<p>{{ $user->email ?? ''}}</p>
			</div>
		</div>
		<nav>
			<ul class="aside-navigation nav">
				<li class="nav-item">
					<a href="#my-orders" data-bs-toggle="tab">
						<i class="fa fa-gift fa-lg"></i> My Orders
					</a>
				</li>
				<li class="nav-item">
					<a href="#Profile" data-bs-toggle="tab">
						<i class="far fa-credit-card"></i> Profile
					</a>
				</li>
				<li class="nav-item">
					<a href="#Address" data-bs-toggle="tab">
						<i class="far fa-envelope"></i> Address
					</a>
				</li>
				<!-- <li class="nav-item">
					<a href="#bank-details" data-bs-toggle="tab">
						<i class="fas fa-tasks"></i> Bank Details
					</a>
				</li> -->
				<li class="nav-item">
					<a href="#change-password" data-bs-toggle="tab">
						<i class="fas fa-tasks"></i> Change Password
					</a>
				</li>
				<li class="nav-item">
					@if(Auth::check())
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> 
						<i class="fas fa-tasks"></i>
						{{ __('Log Out') }}
						</x-dropdown-link>
						
					</form>
					@endif
				</li>
			</ul>
		</nav>
	</div>
	<div class="page">
		<div class="inner-page">
			<div class="col-12">
				
				<div class="tab-content shadow p-3 border bg-white">
					@if(Session::has('msg'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
					@endif
					<div id="my-orders" class="tab-pane">
						<h5>My Orders</h5>
						<?php //echo '<pre>';//print_r($product); ?>
						@if( isset( $orders ) && !empty( $orders ) )
							@foreach( $orders as $order )
								@if( isset( $order ) && !empty( $order ) )
								<?php 
								//echo '<pre>';print_r($product[$order->id]); 
								if(isset($order->orderDetails[0]->product_attribute_id) && !empty($order->orderDetails[0]->product_attribute_id)){
									$image = $product_attribute[$order->id][$order->orderDetails[0]->product_attribute_id]->productAttributeImage[0]->image;
								}else{
									$image = $product[$order->id][$order->orderDetails[0]->product_id]->image;
								}
								?>
								<div class="old-orders p-2 mt-2">
									<div class="row">
										<div class="col-md-2 col-sm-2 col-3">
											<div class="text-center">
												<figure><img width="20%" src="{{ URL::asset($image) ?? '' }}" alt=""></figure>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-6">
											<div class="product-title">
												<strong>Order Id : {{ $order->order_code ?? '' }}</strong>                        
											</div>
											<div class="item-price">
												<p>                                    
													<ins>Rs. {{ $order->payable_amount ?? '' }}</ins>
													<del>Rs. {{ ($order->total + $order->shipping) ?? ''}}</del>
												</p>
												<p class="purchage-date">order date - {{ $order->created_at ?? '' }}</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-3 text-end">
											<!--<a href="javascript:void(0)" class="btn btn-sm py-1 px-3 btn-outline-primary rounded-0">
												Buy Again
											</a>-->
										</div>
									</div>
								</div>
								@endif
							@endforeach
						@endif		
						<!--<div class="default-order p-2 mt-2">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-12">
									<div class="text-center">
										<figure>
											<img src="images/login.png" alt="">
										</figure>
									</div>
								</div>								
								<div class="col-md-12 col-sm-12 col-12 text-center mt-md-4 mt-2">
									<a href="javascript:void(0)" class="btn py-1 px-3 btn-primary rounded-0">
										Buy Now
									</a>
								</div>
							</div>
						</div>-->
					</div>
					<div id="Profile" class="tab-pane active">
						<h5>My Profile</h5>
						<hr>
						<form action="{{ route('profile-update', $user->id ) }}" method="POST">
							@csrf
							<div class="row gy-2">
								<div class="col-md-8 col-sm-8 col-12">
									<div class="row gy-2">
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">First Name</label>
												<input type="text" name="first_name" class="form-control rounded-0" value="{{ $user->first_name ?? ''}}" placeholder="First Name">
											</div>
											@error('first_name')<p class="text-danger">{{ $message }}</p>@enderror
										</div>	
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">Middle Name</label>
												<input type="text" name="middle_name" class="form-control rounded-0" value="{{ $user->middle_name ?? ''}}" placeholder="Middle Name">
											</div>
											@error('middle_name')<p class="text-danger">{{ $message }}</p>@enderror
										</div>
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">Last Name</label>
												<input type="text" name="last_name" class="form-control rounded-0" value="{{ $user->last_name ?? ''}}" placeholder="Last Name">
											</div>
											@error('last_name')<p class="text-danger">{{ $message }}</p>@enderror
										</div>	
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="row gy-2">
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="Number">Contact Number</label>
												<input type="text" name="mobile" class="form-control rounded-0" value="{{ $user->mobile ?? ''}}" placeholder="Contact Number">
											</div>	
											@error('mobile')<p class="text-danger">{{ $message }}</p>@enderror							
										</div>
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="email">Emai Id</label>
												<input type="email" name="email" class="form-control rounded-0" value="{{ $user->email ?? ''}}" placeholder="Email Id">
											</div>	
											@error('email')<p class="text-danger">{{ $message }}</p>@enderror							
										</div>
									</div>	
								</div>	
								<div class="col-md-7 col-sm-7 col-12 text-center mt-md-4 mt-2">
									<button type="submit" name="submit" class="btn py-1 px-3 btn-primary rounded-0">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div id="Address" class="tab-pane">
						<h5>Add/Edit Address</h5>
						<hr>
						<div class="row">
							@if( isset( $addresses ) && !empty( $addresses ) )
								@foreach( $addresses as $address )
									@if( isset( $address ) && !empty( $address ) )
									<div class="col-md-6 col-sm-6 col-12 address_{{ $address->uuid ?? '' }}" >
										<div class="mb-2 border p-2">
											<span class="form-check float-start">
												<input type="radio" class="form-check-input" name="optradio" value="{{ $address->address_type ?? '' }}" onclick="makeDefault( '{{ $address->uuid }}' )"
												 {{ ( ( isset( $address->default_address ) && $address->default_address == 1 ) ) ? 'checked' : '' }} >
											</span>
											<div>
												<strong>{{ ucwords($address->address_type) ?? '' }}</strong>
												<span class="float-end"><i class="fas fa-ellipsis-v"></i></span>
											</div>
											<div class="px-4">
												{{ ucFirst($address->name) ?? ''}}<br>{{ $address->contact ?? ''}} <br>
                                                {{ isset($address->address) ? $address->address.',' : ''}} {{ isset($address->landmark) ? $address->landmark.',' : ''}} {{ isset($address->city) ? $address->city.',' : ''}}<br>{{ isset($address->state) ? $address->state.'-' : ''}} {{ isset($address->zip) ? $address->zip : ''}}
											</div>
											<hr>
											<span class="btn btn-sm btn-danger" onclick="removeAddress( '{{ $address->uuid }}' )">Remove</span>
											<span class="btn btn-sm btn-primary float-end" onclick="editAddress( '{{ $address->uuid }}' )">Edit</span>
										</div>				
									</div>
									@endif
								@endforeach
							@endif		
                            <!--<div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2 border p-2">
                                    <span class="form-check float-start">
                                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="home" checked>
                                    </span>
                                    <div>
                                        <strong>HOME</strong>
                                        <span class="float-end"><i class="fas fa-ellipsis-v"></i></span>
                                    </div>
                                    <div class="px-4">Ram kumar<br>8802801995 <br>
                                        Vipul Agora Building, near sahara mall, MG Road, Gurgaon,<br>
                                        Gurgaon, Haryana - 122002
                                    </div>
									<hr>
									<span class="btn btn-sm btn-danger">Remove</span>
									<span class="btn btn-sm btn-primary float-end">Edit</span>
                                </div>				
                            </div>-->
                        </div>
						<br><br>
						<div class="row">
							<div class="col-md-8 col-sm-8 col-12">
								<div class="mb-2 border p-2">
									<form action="{{route('store')}}" method="POST" class="addHref">
										@csrf
										<input type="hidden" name="profile" value="1">
										<input type="hidden" name="uuid" value="" id="uuid">
										<div class="row gy-2">
											<div class="col-md-6 col-sm-6 col-12">
												<div class="form-group">
													<label for="name">Name</label>
													<input type="text" name="name" id="name" class="form-control rounded-0">
													@error('name')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-6 col-sm-6 col-12">
												<div class="form-group">
													<label for="Number">Mobile Number</label>
													<input type="text" name="contact" id="contact" class="form-control rounded-0">
													@error('contact')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											
											<div class="col-md-6 col-sm-6 col-12">
												<div class="form-group">
													<label for="Area">Address*</label>
													<textarea type="text" rows="2" name="address" id="address" class="form-control rounded-0"></textarea>
													@error('address')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-6 col-sm-6 col-12">
												<div class="form-group">
													<label for="Landmark">Landmark (Optional)</label>
													<textarea type="text" rows="2" name="landmark" id="landmark" class="form-control rounded-0"></textarea>
													@error('landmark')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-4 col-sm-4 col-12">
												<div class="form-group">
													<label for="pinecode">Pine Code</label>
													<input type="text" name="zip" id="zip" class="form-control rounded-0">
													@error('zip')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-4 col-sm-4 col-12">
												<div class="form-group">
													<label for="pinecode">Town / City*</label>
													<input type="text" name="city" id="city" class="form-control rounded-0">
													@error('city')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-4 col-sm-4 col-12">
												<div class="form-group">
													<label for="pinecode">State</label>
													<input type="text" name="state" id="state" class="form-control rounded-0">
													@error('state')<p class="text-danger">{{ $message }}</p>@enderror
												</div>								
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="form-check">
													<input type="radio" class="form-check-input" id="home" name="optradio" value="home">
													<label class="form-check-label" for="home">Home</label>
													@error('optradio')<p class="text-danger">{{ $message }}</p>@enderror
												</div>		
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="form-check">
													<input type="radio" class="form-check-input" id="office" name="optradio" value="office">
													<label class="form-check-label" for="office">Office</label>
													@error('optradio')<p class="text-danger">{{ $message }}</p>@enderror
												</div>		
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="form-check">
													<input type="radio" class="form-check-input" id="other" name="optradio" value="other">
													<label class="form-check-label" for="other">Other</label>
													@error('optradio')<p class="text-danger">{{ $message }}</p>@enderror
												</div>		
											</div>
											<div class="col-md-12 col-sm-12 col-6">
												<div class="mb-2 mt-3">
													<div class="form-check">
														<input type="checkbox" class="form-check-input" id="default_address" name="default_address" value="1" >
														<label class="form-check-label" for="default_address">This is my Default Address</label>
														@error('default_address')<p class="text-danger">{{ $message }}</p>@enderror
													</div>
												</div>				
											</div>
											<div class="col-md-12 col-sm-12 col-12 text-center mt-md-4 mt-2"><hr>
												<button type="submit" name="submit" class="btn py-1 px-3 btn-primary rounded-0">
													Submit / Update
												</button>
											</div>
										</div>
									</form>	
								</div>							
							</div>
						</div>						
					</div>
					<div id="bank-details" class="tab-pane">						
					</div>
					<div id="change-password" class="tab-pane">
						<h5>Update/Change Password</h5>
						<hr>
						<form action="{{route('password-reset')}}" method="POST">
							@csrf
							<div class="row gy-2">
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="Old Password">Old Password</label>
										<input type="password" class="form-control rounded-0" name="old_password" id="old_password">
										@error('old_password')<p class="text-danger">{{ $message }}</p>@enderror
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="New Password">New Password</label>
										<input type="password" class="form-control rounded-0" name="password" id="password">
										@error('password')<p class="text-danger">{{ $message }}</p>@enderror
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="Confirm Password">Confirm Password</label>
										<input type="password" class="form-control rounded-0" name="password_confirmation" id="password_confirmation">
										@error('password_confirmation')<p class="text-danger">{{ $message }}</p>@enderror
									</div>								
								</div>
								<div class="col-md-12 col-sm-12 col-12 mt-md-4 mt-2"><hr>
									<button type="submit" name="submit" class="btn py-1 px-3 btn-primary rounded-0">Update</button>
								</div>
							</div>
						</form>							
					</div>
				</div>
			</div>				
		</div>
	</div>
</div>	
@endsection

@section('script')	
<script>

	function makeDefault(id){
		var url = "{{ url('address/make-default') }}" + '/' + id;
        $.ajax({
            type: 'get',
            url: url,
            data: { _token: "{{ csrf_token() }}", ajax:true },
            success: function(response) { 
                alert("Set as Default Address.");
            }
        });
    }

	function removeAddress(id){
		var url = "{{ url('address/remove') }}" + '/' + id;
        $.ajax({
            type: 'get',
            url: url,
            data: { _token: "{{ csrf_token() }}", ajax:true },
            success: function(response) { 
				if(response){
					$(".address_" + id).hide();
                	alert("Address Removed");
				}else{
					alert('You are not authorized to do this!');
				}
				 
            }
        });
    }

	function editAddress(id){
		var url = "{{ url('address/get-address') }}" + '/' + id;
        $.ajax({
            type: 'get',
            url: url,
            data: { _token: "{{ csrf_token() }}", ajax:true },
            success: function(response) { 
				var resp = JSON.parse(response);
				console.log(resp);
				if(resp){
					$("#name").val(resp.name);
					$("#contact").val(resp.contact);
					$("#address").val(resp.address);
					$("#landmark").val(resp.landmark);
					$("#city").val(resp.city);
					$("#state").val(resp.state);
					$("#zip").val(resp.zip);
					
					$("#home").prop('checked',false);
					$("#office").prop('checked',false);
					$("#other").prop('checked',false);
					$("#default_address").prop('checked',false);

					if(resp.address_type == 'home'){
						$("#home").prop('checked',true);
					}else if(resp.address_type == 'office'){
						$("#office").prop('checked',true);
					}else if(resp.address_type == 'other'){
						$("#other").prop('checked',true);
					}
					
					if(parseInt(resp.default_address) == 1){
						$("#default_address").prop('checked',true);
					}
					
					var href = "{{ url('address/update') }}"; 
        			$(".addHref").attr('action', href)
					$("#uuid").val(resp.uuid);
                	
				}else{
					alert('You are not authorized to do this!');
				}
				 
            }
        });
    }

</script>
@endsection	




