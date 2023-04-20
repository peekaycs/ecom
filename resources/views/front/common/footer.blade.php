
<footer>
	<span class="footerplus f-toggle"><i class="fa fa-plus"></i> </span>
	<div class="container-fluid m-footer">		
		<div class="row">
			<div class="col-md-2 col-sm-2 col-6">
				<div class="footer-contant">
					<h3>{{env('APP_NAME')}}</h3>
					@if(!empty($pages))
					<ul>
						@if(isset($pages) && !empty($pages))
							@foreach($pages as $page)
								@if($loop->iteration >= 4)
								@php
									$pages->shift(3);
								@endphp
									@break
								@endif
								<li><a href="{{ route('front.pages', App\Helpers\Helper::constructSlug($page->slug)) }}">{{$page->name}}</a></li>
							@endforeach
						@endif
					</ul>
					@endif
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-6">
				<div class="footer-contant">
					<h3>Policies</h3>
					@if(!empty($pages))
					<ul>
						@if(isset($pages) && !empty($pages))
							@foreach($pages as $page)
								@if($loop->iteration >= 4)
									@php
									$pages->shift(3);
									@endphp
									@break
								@endif
								<li><a href="{{ route('front.pages', App\Helpers\Helper::constructSlug($page->slug)) }}">{{$page->name}}</a></li>
							@endforeach
						@endif
					</ul>
					@endif
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-6">
				<div class="footer-contant">
					<h3>Top Products</h3>
					<ul>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>								
					</ul>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-6">
				<div class="footer-contant">
					<h3>Address</h3>
					<ul>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>
						<li><a href="javascript:void(0)">Lorem ipsum dolor</a></li>								
					</ul>
				</div>
			</div>			
			<div class="col-md-3 col-sm-3 col-12">
				<div class="footer-contant">
					<h3>Help Us Spread the Word</h3>
					<ul>
						<li><a href="#">Sports Nutrition</a></li>
						<li><a href="#">Like, Follow or Tweet or posts. We Just Love Interacting With You.</a></li>
					</ul>
					<h6 class="m-0">Subscribe to our newsletter</h6>
					<div class="input-group mt-2">
						<input type="text" class="form-control" placeholder="Search">
						<button class="btn" type="submit">Go</button>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="all-right">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-12">
				<div class="social mb-2 text-start">
					<h5>Follow US </h5>
					<a href="#"><img src="{{URL::asset('assets/front/images/fb.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/g-plus.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/tweeter.png')}}"></a>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-12">
				<div class="accept-card mb-2 text-md-end text-start">
					<h5 class="text-start">We Accept </h5>
					<a href="#"><img src="{{URL::asset('assets/front/images/jbc.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/maestro.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/mastercard.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/visa.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/union-pay.png')}}"></a>
					<a href="#"><img src="{{URL::asset('assets/front/images/discover.png')}}"></a>
					<!-- <a href="#"><img src="images/diners.png"></a> -->
				</div>
			</div>
		</div>
		<hr>
		<p>Disclaimer - - You are kindly advised to check the genuineness of all companies listed above on your own behalf prior to signing a contract with them. We are in no way responsible for any loss. <a href="{{route('front.disclaimer')}}"> Read Complete Disclaimer</a></p>
	</div> 
</footer>

<div id="top-scroll" class="scroll-top">
	<img width="40px" data-src="{{URL::asset('assets/front/images/to_top_icon.png')}}" class="lazyload" alt="">
</div>

<div id="login" class="login-modal">  
  	<form class="modal-content animate" action="{{route('login')}}" method="post">
	    <div class="imgcontainer">
	      	<span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
	     	 <img src="{{URL::asset('assets/front/images/login_icon.png')}}" alt="Avatar" class="avatar">
	    </div>
		@csrf
	    <div class="container">
	    	<div class="col-md-12 col-sm-12 col-xs-12">
	      		<label for="uname"><b>Email Address</b></label>
	      		<input type="email" placeholder="Email Address" name="email" required>
	      	</div>
	      	<div class="col-md-12 col-sm-12 col-xs-12">
	      		<label for="psw"><b>Password</b></label>
	      		<input type="password" placeholder="Enter Password" name="password" required>
		    </div>
		    <div class="col-md-12 col-sm-12 col-xs-12">   
	      		<div class="login-btn">
	      			<button type="submit">Login</button>
	      		</div>
	      	</div>
	      	<div class="col-md-12 col-sm-12 col-xs-12">
	      		<!-- <label><input type="checkbox" checked="checked" name="remember"> Remember me</label> -->
	      	</div>
	    </div>

    	<div class="container" style="background-color:#f1f1f1">
      		<span class="psw"><a href="{{route('signup')}}">Signup</a></span>
    	</div>
  	</form>
</div>






