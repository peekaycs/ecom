@extends('front.layouts.app')
@section('content')
<div class="dashboard">			
	<div class="account-aside">
		<div class="aside-profile">
			<span><img src="{{ URL::asset('assets/front/images/login.png') }}" alt=""></span>
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
							
							<i class="fas fa-tasks"></i>
							<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> {{ __('Log Out') }}
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
					<div id="my-orders" class="tab-pane">
						<h5>My Orders</h5>
						@if( isset( $orders ) && !empty( $orders ) )
							@foreach( $orders as $order )
								@if( isset( $order ) && !empty( $order ) )
								<div class="old-orders p-2 mt-2">
									<div class="row">
										<div class="col-md-2 col-sm-2 col-3">
											<div class="text-center">
												<figure><img src="images/p1.jpg" alt=""></figure>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-6">
											<div class="product-title">
												<strong>Essential Oil Blends – 10mL</strong>                        
											</div>
											<div class="item-price">
												<p>                                    
													<ins>Rs. 255,00</ins>
													<del>Rs. 240,00</del>
												</p>
												<p class="purchage-date">order date - 15-03-2023</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-3 text-end">
											<a href="javascript:void(0)" class="btn btn-sm py-1 px-3 btn-outline-primary rounded-0">
												Buy Again
											</a>
										</div>
									</div>
								</div>
								@endif
							@endforeach
						@endif		
						<!--<div class="old-orders p-2 mt-2">
							<div class="row">
								<div class="col-md-2 col-sm-2 col-3">
									<div class="text-center">
										<figure>
											<img src="images/p2.jpg" alt="">
										</figure>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<div class="product-title">
										<strong>Essential Oil Blends – 10mL</strong>                        
									</div>
									<div class="item-price">
										<p>                                    
											<ins>Rs. 255,00</ins>
											<del>Rs. 240,00</del>
										</p>
										<p class="purchage-date">order date - 15-03-2023</p>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-3 text-end">
									<a href="javascript:void(0)" class="btn btn-sm py-1 px-3 btn-outline-primary rounded-0">
										Buy Again
									</a>
								</div>
							</div>
						</div>
						<div class="old-orders p-2 mt-2">
							<div class="row">
								<div class="col-md-2 col-sm-2 col-3">
									<div class="text-center">
										<figure>
											<img src="images/p3.jpg" alt="">
										</figure>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<div class="product-title">
										<strong>Essential Oil Blends – 10mL</strong>                        
									</div>
									<div class="item-price">
										<p>                                    
											<ins>Rs. 255,00</ins>
											<del>Rs. 240,00</del>
										</p>
										<p class="purchage-date">order date - 15-03-2023</p>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-3 text-end">
									<a href="javascript:void(0)" class="btn btn-sm py-1 px-3 btn-outline-primary rounded-0">
										Buy Again
									</a>
								</div>
							</div>
						</div>
						<div class="default-order p-2 mt-2">
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
						<form action="{{ route('update') }}" method="POST">
							@csrf
							<div class="row gy-2">
								<div class="col-md-8 col-sm-8 col-12">
									<div class="row gy-2">
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">First Name</label>
												<input type="text" class="form-control rounded-0" value="{{ $user->first_name ?? ''}}" placeholder="First Name">
											</div>
										</div>	
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">Middle Name</label>
												<input type="text" class="form-control rounded-0" value="{{ $user->middle_name ?? ''}}" placeholder="Middle Name">
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="name">Last Name</label>
												<input type="text" class="form-control rounded-0" value="{{ $user->last_name ?? ''}}" placeholder="Last Name">
											</div>
										</div>	
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="row gy-2">
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="Number">Contact Number</label>
												<input type="text" class="form-control rounded-0" value="{{ $user->mobile ?? ''}}" placeholder="Contact Number">
											</div>								
										</div>
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="email">Emai Id</label>
												<input type="email" class="form-control rounded-0" value="{{ $user->email ?? ''}}" placeholder="Email Id">
											</div>								
										</div>
									</div>	
								</div>	
								<div class="col-md-7 col-sm-7 col-12 text-center mt-md-4 mt-2">
									<button type="button" name="submit" class="btn py-1 px-3 btn-primary rounded-0">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div id="Address" class="tab-pane">
						<h5>Add/Edit Address</h5>
						<hr>
						<div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-2 border p-2">
                                    <span class="form-check float-start">
                                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="home" checked>
                                    </span>
                                    <div>
                                        <strong>OFFICE</strong>
                                        <span class="float-end"><i class="fas fa-ellipsis-v"></i></span>
                                    </div>
                                    <div class="px-4">Ram kumar<br>8802801956 <br>
                                        Vipul Agora Building, near sahara mall, MG Road, Gurgaon,<br>
                                        Gurgaon, Haryana - 122002
                                    </div>
									<hr>
									<span class="btn btn-sm btn-danger">Remove</span>
									<span class="btn btn-sm btn-primary float-end">Edit</span>
                                </div>				
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
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
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-8 col-sm-8 col-12">
								<form action="">
									<div class="row gy-2">
										<div class="col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="name">Name</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="Number">Mobile Number</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="Alternate-Number">Alternate Mobile Number</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="Flat">Flat / House no. / Building / Company*</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="Area">Road Name, Street, Area, Colony*</label>
												<textarea type="text" rows="1" class="form-control rounded-0"></textarea>
											</div>								
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="Landmark">Landmark (Optional)</label>
												<textarea type="text" rows="1" class="form-control rounded-0"></textarea>
											</div>								
										</div>
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="pinecode">Pine Code</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="pinecode">Town / City*</label>
												<input type="text" class="form-control rounded-0">
											</div>								
										</div>
										<div class="col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="pinecode">State</label>
												<select name="" id="" class="form-select rounded-0">
													<option value="">select city</option>
												</select>
											</div>								
										</div>
										<div class="col-md-4 col-sm-4 col-6">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="Office" name="optradio" value="office">
												<label class="form-check-label" for="Office">Office</label>
											</div>		
										</div>
										<div class="col-md-4 col-sm-4 col-6">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="Home" name="optradio" value="other">
												<label class="form-check-label" for="Home">Home</label>
											</div>		
										</div>
										<div class="col-md-4 col-sm-4 col-6">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="Other" name="optradio" value="other">
												<label class="form-check-label" for="Other">Other</label>
											</div>		
										</div>
										<div class="col-md-12 col-sm-12 col-6">
											<div class="mb-2 mt-3">
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="Other" name="optradio" value="other">
													<label class="form-check-label" for="Other">This is my Default Address</label>
												</div>
											</div>				
										</div>
										<div class="col-md-12 col-sm-12 col-12 text-center mt-md-4 mt-2"><hr>
											<button type="button" name="submit" class="btn py-1 px-3 btn-primary rounded-0">
												Submit / Update
											</button>
										</div>
									</div>
								</form>								
							</div>
						</div>						
					</div>
					<div id="bank-details" class="tab-pane">						
					</div>
					<div id="change-password" class="tab-pane">
						<h5>Update/Change Password</h5>
						<hr>
						<form action="">
							<div class="row gy-2">
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="Old Password">Old Password</label>
										<input type="text" class="form-control rounded-0">
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="New Password">New Password</label>
										<input type="text" class="form-control rounded-0">
									</div>								
								</div>
								<div class="col-md-7 col-sm-7 col-12">
									<div class="form-group">
										<label for="Confirm Password">Confirm Password</label>
										<input type="text" class="form-control rounded-0">
									</div>								
								</div>
								<div class="col-md-12 col-sm-12 col-12 mt-md-4 mt-2"><hr>
									<button type="button" name="submit" class="btn py-1 px-3 btn-primary rounded-0">
										Submit / Update
									</button>
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



