<section class="slide-section mt-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-12">
				<h4 class="heading">Popular Healthcare Products</h4>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="scroll float-end">
					<ul class="nav nav-pills scroll-max-width">
						<li class="nav-item">
							<a class="active popular" data-bs-toggle="pill" href="#Latest_Products" >Latest Products</a>
						</li>
						<li class="nav-item">
							<a class="popular" data-bs-toggle="pill" href="#Top_Rating_Products" >Top Rating Products</a>
						</li>
						<li class="nav-item">
							<a class="popular" data-bs-toggle="pill" href="#Featured_Products" >Featured Products</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">                
				<div class="">
					<div id="Latest_Products" class="tab-pane active slide-popular">
						<div class="product-slide">
							@if (isset($latest) && !empty($latest))
								@foreach($latest as $best) 
									@if (isset($best) && !empty($best))
									<div class="product-box">
										<span class="product-offer">-{{ $best->discount ?? ''}}%</span>
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $best->slug)]) }}" class="text-center">
											<img src="{{URL::asset($best->image)}}" alt="">
										</a>
										<div class="categories-name">
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $best->slug)]) }}">{{ $best->category->category ?? '' }}</a>
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $best->slug)]) }}">{{ $best->subcategory->subcategory ?? '' }}</a>
										</div>
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $best->slug)]) }}">
											<h5 class="product-name">{{ $best->product ?? '' }} – {{ (isset($best->productAttribute[0]->attribute->name)) ? $best->productAttribute[0]->attribute->name : '' }}</h5>
										</a>
										<p class="item-price">     
											<?php $price = $best->price - (($best->price * $best->discount) / 100); ?>                               
											<ins>{{ $price ?? '' }}</ins>
											<del>{{ $best->price ?? '' }}</del>
										</p>
										<!-- <div class="add-to-cart">
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $best->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
										</div> -->
									</div>
									@endif
								@endforeach	
							@endif    
						</div>
					</div>
					<div id="Top_Rating_Products" class="tab-pane slide-popular" style="height: 0px;">
						<div class="product-slide">
							@if (isset($topRating) && !empty($topRating))
								@foreach($topRating as $top_rated) 
									@if (isset($top_rated) && !empty($top_rated))
									<div class="product-box">
										<span class="product-offer">-{{ $top_rated->discount ?? '' }}%</span>
										<a href="javascript:void(0)" class="text-center">
											<img src="{{URL::asset($top_rated->image)}}" alt="">
										</a>
										<div class="categories-name">
											<a href="javascript:void(0)">{{ $top_rated->category->category ?? '' }}</a>
											<a href="javascript:void(0)">{{ $top_rated->subcategory->subcategory ?? '' }}</a>
										</div>
										<a href="javascript:void(0)">
											<h5 class="product-name">{{ $top_rated->product ?? '' }} {{ (isset($top_rated->productAttribute[0]->attribute->name)) ? ' - '.$top_rated->productAttribute[0]->attribute->name : '' }}</h5>
										</a>
										<p class="item-price">     
											<?php $price = $top_rated->price - (($top_rated->price * $top_rated->discount) / 100); ?>                               
											<ins>{{ $price ?? '' }}</ins>
											<del>{{ $top_rated->price ?? '' }}</del>
										</p>
										<div class="add-to-cart">
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $top_rated->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
										</div>
									</div>
									@endif
								@endforeach
							@endif    
						</div>
					</div>
					<div id="Featured_Products" class="tab-pane slide-popular" style="height:0px">
						<div class="product-slide">
							@if (isset($feature) && !empty($feature))
								@foreach($feature as $featured) 
									@if (isset($featured) && !empty($featured))
									<div class="product-box">
										<span class="product-offer">-{{ $featured->discount ?? '' }}%</span>
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $featured->slug)]) }}" class="text-center">
											<img src="{{ URL::asset($featured->image) ?? '' }}" alt="">
										</a>
										<div class="categories-name">
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $featured->slug)]) }}">{{ $featured->category->category ?? '' }}</a>
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $featured->slug)]) }}">{{ $featured->subcategory->subcategory ?? '' }}</a>
										</div>
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $featured->slug)]) }}">
											<h5 class="product-name">{{ $featured->product ?? '' }} – {{ (isset($featured->productAttribute[0]->attribute->name)) ? $featured->productAttribute[0]->attribute->name : '' }}</h5>
										</a>
										<p class="item-price">     
											<?php $price = $featured->price - (($featured->price * $featured->discount) / 100); ?>                               
											<ins>{{ $price ?? '' }}</ins>
											<del>{{ $featured->price ?? '' }}</del>
										</p>
										<!-- <div class="add-to-cart">
											<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $featured->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
										</div> -->
									</div>
									@endif
								@endforeach
							@endif    
						</div>
					</div>    	
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	function makeActive(idd){
		alert(idd);
		$(".popular").removeClass('active');
		$(".popular").addClass('fade');

		$("#" + idd).removeClass('fade');
		$("#" + idd).addClass('active');
	}
</script>    