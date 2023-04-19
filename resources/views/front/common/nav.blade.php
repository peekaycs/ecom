<div class="top-head">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-12">
				<span class="top-head-left">India's Best homeopathy medicine Platform</span>
			</div>
			<div class="col-md-6 col-sm-12 col-12">					
				<ul>					
					<li class="toll-free">
						<a href="#">
							<img class="call" src="{{URL::asset('assets/front/images/call.png')}}">
							<span >1800-14712-9999 <small>Toll Free</small></span>
						</a>
					</li>
					<li class="app-download">
						<a href="#">
							<img class="appdownload" src="{{URL::asset('assets/front/images/android-512.png')}}">
							<span>Download App</span>
						</a>
					</li>
					@if(Auth::check())
					<li class="profile-icon">
						<a href="#">
							<i class="fas fa-user-tie"></i>
							<span class="d-display">Hi, {{Auth::user()->first_name}}</span>
							<!-- <i class="fas fa-caret-down"></i> -->
						</a>
					</li>
					<div class="profile-ddp">
						<ul>
							<li><a href="{{ route('user-profile') }}"><i class="fa fa-user-circle"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
							<li>
								<i class="fa fa-sign-out">
								@if(Auth::check())
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<x-dropdown-link :href="route('logout')"
													onclick="event.preventDefault();
																this.closest('form').submit();">
												{{ __('Log Out') }}
											</x-dropdown-link>
										</form>
										@endif
								</i>
							</li>
						</ul>
					</div>
					@else
					<li class="login">
						<a href="#" onclick="document.getElementById('login').style.display='block'"> Login</a>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="head">
	<div class="container-fluid">
		<header>							
			<div id="sideNav" href="#" class="toggle">
				<i class="fa fa-bars"></i> 
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-12">
					<a class="logo zoomimg" id="flip" href="{{ route('home') }}">
						<img src="{{URL::asset('assets/front/images/logo.png')}}" alt="Logo">
					</a>
				</div>	
				<div class="col-md-9 col-sm-12 col-12">
					<div class="header-menu">
						<ul>	
							<li><a href="#">Homeopathy <i class="fas fa-caret-down"></i></a>
								<div class="dropdown-on-hover">
									<div class="ddp-inner">
										@if (isset($category) && !empty($category))
											@foreach($category as $cat)
												@if (isset($cat) && !empty($cat))
												<ul>
													<p><strong>{{ $cat->category ?? '' }}</strong></p>
													@if (isset($cat->subcategory) && !empty($cat->subcategory))
														@foreach($cat->subcategory as $subcat)
															@if (isset($subcat) && !empty($subcat))
															<li>
																<a href="{{ route('productBySubCategory',['slug' => str_replace(' ', '-', $subcat->slug)]) }}">{{ $subcat->subcategory ?? '' }}</a>
															</li>
															@endif	
														@endforeach
													@endif
												</ul>
												@endif	
											@endforeach
										@endif 
										<!--
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>
										<ul>
											<p><strong>Medicines</strong></p>
											<li>
												<a href="javascript:void(0)">	
													Medicines
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Dilutions 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Mother Tinctures 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Biochemic Tablets 
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													Homeopathic Trituration Tablets 
												</a>
											</li>
										</ul>-->
									</div>								
								</div>								
							</li>
						</ul>
					</div>
				</div>
				<div class="cart">
					<a href="{{route('cart_list')}}">
						<img src="{{URL::asset('assets/front/images/cart.png')}}" alt="">
						<span class="badge bg-success">{{ $count ?? '' }}</span>
					</a>
				</div>
				<div class="head-search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search">
						<button class="btn" type="submit">
							<span>Search</span>	
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</div>				
		</header>
	</div>		
</div>
<div class="menu">
	<!--<div class="d-md-block d-none header-sticky">
		<ul class="nav navbar-nav">
			<li>
				<a href="digital-marketing.php" style="padding-left:10px">
					<img src="{{URL::asset('assets/front/images/hot-deal.png')}}" alt="">	
					Deals
				</a>
			</li>			
			
			<li>
				<a href="hosting-services.php">
					<img src="{{URL::asset('assets/front/images/consult.png')}}" alt="">
					Consult
				</a>
			</li>
			<li>
				<a href="website-desiging.php">
					<img src="{{URL::asset('assets/front/images/homeopathy.png')}}" alt="">
					Homeopathy
				</a>
			</li>
			<li>
				<a href="data-server.php">
					<img src="{{URL::asset('assets/front/images/schedule.png')}}" alt="">Nutrition & Supplements
				</a>
			</li>
			<li>
				<a href="cloud-data.php">
					<img src="{{URL::asset('assets/front/images/muscle.png')}}" alt="">Health Aid & Fitness
				</a>
			</li>
			<li>
				<a href="app-development.php">
					<img src="{{URL::asset('assets/front/images/sexual.png')}}" alt="">Sexual Wellness
				</a>
			</li>					
		</ul>
	</div>-->
</div>