<!-- Carousel -->
<div id="slider" class="carousel slide" data-bs-ride="carousel">
	<!-- Indicators/dots -->
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active"></button>
		<button type="button" data-bs-target="#slider" data-bs-slide-to="1"></button>
	</div>

    <!-- The slideshow/carousel -->
  	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="{{URL::asset('assets/front/images/banner.jpg')}}" alt="" class="d-block" style="width:100%">
		</div>
		<div class="carousel-item">
			<img src="{{URL::asset('assets/front/images/banner2.jpg')}}" alt="" class="d-block" style="width:100%">
		</div>
  	</div>
  
  	<!-- Left and right controls/icons -->
  	<button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
    	<span class="carousel-control-prev-icon"></span>
  	</button>
  	<button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
    	<span class="carousel-control-next-icon"></span>
  	</button>
</div>
