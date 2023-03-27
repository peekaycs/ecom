@extends('front.layouts.app')

@section('content')	
<section class="mt-4">
	<div class="container-fluid">
		<div class="row">			
			<div class="col-md-3 col-sm-3 col-12">
				<div class="aside-filter">
					<h3>FILTERS BY</h3>
					<div class="cat-box">						
						<h4>{{ $filter_categories->category ?? '' }}</h4>
						<div class="search-icon">
							<input type="type" name="search" class="form-control" placeholder="Search Medicine Name" autocomplete="off">
						</div>
						<div class="check-list">
							@if (isset($filter_subcategories) && !empty($filter_subcategories))
								@foreach($filter_subcategories as $filter_subcategory)
									@if (isset($filter_subcategory) && !empty($filter_subcategory))
									<label class="chk">
										<input type="checkbox"><span class="checkmark1"></span><a href="{{ route('productBySubCategory',['slug' => str_replace(' ', '-', $filter_subcategory->slug)]) }}" style="text-decoration:none;color:grey">{{ $filter_subcategory->subcategory ?? ''}}</a>
									</label>
									@endif
								@endforeach
							@endif		
							<!--<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>Vansaar</label>
							<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>Vedame Herbals
							</label>
							<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>Wisdom Natural
							</label>
							<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>YC Care
							</label>
							<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>Yours
							</label>
							<label class="chk">
							  	<input type="checkbox"><span class="checkmark"></span>Zandu
							</label>-->
						</div>
					</div>
					<div class="cat-box">	
					<h4>Brand</h4>
						<div class="search-icon">
							<input type="type" name="search" class="form-control" placeholder="Search by Brand Name" autocomplete="off">
						</div>
						<div class="check-list">
							@if (isset($brands) && !empty($brands))
								@foreach($brands as $brand)
									@if (isset($brand) && !empty($brand))					
									<label class="chk">
										<input type="checkbox">
										<span class="checkmark"></span>
										{{ $brand->brand ?? ''}}
									</label>
									@endif
								@endforeach
							@endif		
							<!--<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Fitness & Wellness
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Skin care
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Lip Care
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Sexual wellness
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Women's Care
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Baby care
							</label>-->
						</div>
					</div>
					<!-- <div class="cat-box">						
						<h4>DISCOUNT</h4>
						<input type="type" name="search" class="form-control" placeholder="Search medicine name" auto-fill="off">
						<div class="check-list">
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Less than 10%
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	10% and above
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	20% and above
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	30% and above
							</label>
						</div>
					</div> -->
					<!-- <div class="cat-box">						
						<h4>TREATMENT</h4>
						<input type="type" name="search" class="form-control" placeholder="Search medicine name" auto-fill="off">
						<div class="check-list">
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	Less than 10%
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	10% and above
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	20% and above
							</label>
							<label class="chk">
							  	<input type="checkbox">
							  	<span class="checkmark"></span>
							  	30% and above
							</label>
						</div>
					</div> -->
                </div>
			</div>
			<div class="col-md-9 col-sm-9 col-12 mb-3">
				<div class="row mt-2 mb-3 px-1">
					<div class="col-md-7 col-sm-7 col-12">
						<h1 class="page-title">{{ $filter_categories->category ?? ''}} - {{ $subcategories->subcategory ?? ''}}
							<span>(Showing {{ ((($products->currentPage()-1)*$products->perPage())+1) ?? '' }} – {{ $products->count() ?? '' }} products of total {{ $products->total() ?? '' }} products)</span>
						</h1>
					</div>
					<div class="col-md-5 col-sm-5 col-12">
						<div class="sort-by">
							<label>Sort By </label>
							<select class="form-select-sm rounded-0">
								<option>Price Low to High</option>
								<option>Price High to Low</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row g-2">
					@if (isset($products) && !empty($products))
						@foreach($products as $product)
							@if (isset($product) && !empty($product))					
							<div class="col-md-3 col-sm-3 col-6">
								<div class="category-product-box">
									<span class="product-offer">-{{ $top_rated->discount ?? '' }}%</span>
									<a href="javascript:void(0)" class="text-center">
										<img src="{{ URL::asset($product->image) ?? '' }}" alt="">
									</a>
									<div class="categories-name">
										<a href="javascript:void(0)">{{ $product->category->category ?? ''}}</a>
										<a href="javascript:void(0)">{{ $product->subcategory->subcategory ?? ''}}</a>
									</div>
									<a href="javascript:void(0)">
										<h5 class="productdetails.php">{{ $product->product ?? ''}} {{ (isset($c->productAttribute[0])) ? ' - '.$product->productAttribute[0]->attribute->name : '' }}</h5>
									</a>
									<p class="item-price">  
										<?php $price = $product->price - (($product->price * $product->discount) / 100); ?>                                  
										<ins>{{ $price ?? ''}}</ins>
										<del>{{ $product->price ?? ''}}</del>
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
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $product->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
									</div>
								</div>
							</div>
							@endif
						@endforeach
					@endif
					<!--<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
							<span class="product-offer">-16%</span>
							<a href="productdetails.php" class="text-center">
								<img src="images/b1.jpg" alt="">
							</a>
							<div class="categories-name">
								<a href="javascript:void(0)">Personal Care</a>
								<a href="javascript:void(0)">Stomach Pain</a>
							</div>
							<a href="javascript:void(0)">
								<h5 class="productdetails.php">Essential Oil Blends – 10mL</h5>
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
							<span class="product-offer">-16%</span>
							<a href="productdetails.php" class="text-center">
								<img src="images/b1.jpg" alt="">
							</a>
							<div class="categories-name">
								<a href="javascript:void(0)">Personal Care</a>
								<a href="javascript:void(0)">Stomach Pain</a>
							</div>
							<a href="javascript:void(0)">
								<h5 class="productdetails.php">Essential Oil Blends – 10mL</h5>
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
							<span class="product-offer">-16%</span>
							<a href="productdetails.php" class="text-center">
								<img src="images/b1.jpg" alt="">
							</a>
							<div class="categories-name">
								<a href="javascript:void(0)">Personal Care</a>
								<a href="javascript:void(0)">Stomach Pain</a>
							</div>
							<a href="productdetails.php">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="category-product-box">
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
					</div>-->
				</div>
			</div>	
		</div>
	</div>
</section>
@endsection	

