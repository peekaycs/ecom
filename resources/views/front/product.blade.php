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
						<!--<div class="search-icon">
							<input type="type" name="search" class="form-control" placeholder="Search Medicine Name" autocomplete="off">
						</div>-->
						<div class="check-list">
							@if (isset($filter_subcategories) && !empty($filter_subcategories))
								@foreach($filter_subcategories as $filter_subcategory)
									@if (isset($filter_subcategory) && !empty($filter_subcategory))
									<label class="chk ">
										<input type="radio" name="subcategory" class=" {{ str_replace(' ', '-', $filter_subcategory->slug) }} " value="{{ str_replace(' ', '-', $filter_subcategory->slug) }}" {{ request()->is('product/'.str_replace(' ', '-', $filter_subcategory->slug)) ? 'checked' : '' }}>
										<span class="checkmark1"></span>
										<a class="subcategory {{ request()->is('product/'.str_replace(' ', '-', $filter_subcategory->slug)) ? 'actv' : '' }}" href="{{ route('productBySubCategory',['slug' => str_replace(' ', '-', $filter_subcategory->slug)]) }}" style="text-decoration:none;color:grey" data-subcategory="{{ str_replace(' ', '-', $filter_subcategory->slug) }}" data-subcategory="{{ str_replace(' ', '-', $filter_subcategory->slug) }}" >
											{{ $filter_subcategory->subcategory ?? ''}}
										</a>
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
						<!--<div class="search-icon">
							<input type="type" name="search" class="form-control" placeholder="Search by Brand Name" autocomplete="off">
						</div>-->
						<div class="check-list">
							@if (isset($brands) && !empty($brands))
								@foreach($brands as $brand)
									@if (isset($brand) && !empty($brand))					
									<label class="chk">
										<input type="checkbox" name="brand[]" class="brand {{ $brand->id ?? ''}}" data-brand="{{ $brand->id ?? ''}}">
										<span class="checkmark"></span>{{ $brand->brand ?? ''}}
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
							<span class="pagination_info">(Showing {{ ((($products->currentPage()-1)*$products->perPage())+1) ?? '' }} – {{ $products->count() ?? '' }} products of total {{ $products->total() ?? '' }} products)</span>
						</h1>
					</div>
					<div class="col-md-5 col-sm-5 col-12">
						<div class="sort-by">
							<label>Sort By </label>
							<select class="form-select-sm rounded-0 order" >
								<option>Price Low to High</option>
								<option>Price High to Low</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row g-2" class="add_item" id="add_item">
					@if (isset($products) && !empty($products))
						@foreach($products as $product)
							@if (isset($product) && !empty($product))					
							<div class="col-md-3 col-sm-3 col-6">
								<div class="category-product-box">
									<span class="product-offer">-{{ $product->discount ?? '' }}%</span>
									<a href="javascript:void(0)" class="text-center">
										<img src="{{ URL::asset($product->image) ?? '' }}" alt="">
									</a>
									<div class="categories-name">
										<a href="javascript:void(0)">{{ $product->category->category ?? ''}}</a>
										<a href="javascript:void(0)">{{ $product->subcategory->subcategory ?? ''}}</a>
									</div>
									<a href="javascript:void(0)">
										<h5 class="javascript:void(0)">{{ $product->product ?? ''}} {{ (isset($c->productAttribute[0])) ? ' - '.$product->productAttribute[0]->attribute->name : '' }}</h5>
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
				</div>
			</div>	
		</div>
	</div>
</section>
<style>
	.actv{color:black !important;}
</style>
@endsection	

@section('script')	
<script>

    $('.brand').click(function(e){ 
		var brand = '';
		var attr = $(this).attr('checked');
		if (typeof attr !== 'undefined' && attr !== false) {
			$(this).removeAttr('checked')
		}else{
			$(this).attr('checked','checked')
		}
		
		$(".brand").each(function() {
			var attr = $(this).attr('checked');
			if (typeof attr !== 'undefined' && attr !== false) {
				var data = $(this).data('brand');
				brand = brand+','+data
			}
		});
		brand = brand.replace(/(^,)|(,$)/g, "");

		var subcat = '';
		$(".subcategory").each(function() {
			var cls = $(this).hasClass('actv');
			if(cls == true){
				var subcategory = $(this).data('subcategory');
				subcat = $('.' + subcategory).val();
			}
		});
		var order = '';

		/*user = { 
            "brand": brand, 
            "slug": subcat 
        }
        // Options to be given as parameter in fetch for making requests other then GET
        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 
                    'application/json;charset=utf-8'
            },
            body: JSON.stringify(user)
        }*/
        // Fake api for making post requests
        fetch( "{{ url('productByBrand') }}/" +subcat+ '/' +brand)
		.then(res => res.text())
		.then(html => {
			//console.log(html);
			document.getElementById("add_item").innerHTML = html
		})
		//.catch(error => {console.log(error)});
    });



	/*$.ajax({
		type: 'GET',
		url: "{{ url('productByBrand') }}",
		data: { slug : subcat, brand : brand },
		success: function(response) { 
			console.log(response); 
			//response = JSON.parse(response);
			//alert( key + ": " + value );
		}
	});*/
</script>
@endsection	

