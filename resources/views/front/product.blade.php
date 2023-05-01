@extends('front.layouts.app')

@section('content')	
<section class="mt-4">
	<div class="container-fluid">
		<div class="row">			
			<div class="col-md-3 col-sm-3 col-12">
				<div class="aside-filter">
					<div class="aside-desk-filter">
						<h3>FILTERS BY</h3>
						<div class="cat-box">		
							<?php 
							$queryString  = url()->current();
							$queryString = explode('//',$queryString);
							$queryString = explode('/',$queryString[1]);
							$slug = $queryString[2];

							$brandCheck = [];
							$orderCheck = '';
							if( isset($queryString[3]) && !empty($queryString[3]) ){
								if( $queryString[3] == 'ASC' || $queryString[3] == 'DESC' ){
									$orderCheck = $queryString[3];
								}else{
									$brandCheck = explode( ',', $queryString[3] );
								}
							}
							
							if( isset($queryString[4]) && !empty($queryString[4]) ){
								$orderCheck = $queryString[4];
							}
							?>	
							@if (isset($category) && !empty($category))
								@foreach($category as $categories)
									@if (isset($categories) && !empty($categories))				
									<h4>
										<a class="category {{ str_replace(' ', '-', $categories->slug) == $slug ? 'actv' : '' }}" href="{{ route('productByCategory',['slug' => str_replace(' ', '-', $categories->slug)]) }}" style="text-decoration:none;color:grey" data-category="{{ str_replace(' ', '-', $categories->slug) }}" >{{ $categories->category ?? '' }}</a>
									</h4>
									<!--<div class="search-icon">
										<input type="type" name="search" class="form-control" placeholder="Search Medicine Name" autocomplete="off">
									</div>-->
									<div class="check-list">
										@if (isset($categories->subcategory) && !empty($categories->subcategory))
											@foreach($categories->subcategory as $categories->subcategories)
												@if (isset($categories->subcategories) && !empty($categories->subcategories))
												<label class="chk px-0">
													<input type="radio" name="subcategory" class=" {{ str_replace(' ', '-', $categories->subcategories->slug) }} " value="{{ str_replace(' ', '-', $categories->subcategories->slug) }}" {{ request()->is('product/'.str_replace(' ', '-', $categories->subcategories->slug)) ? 'checked' : '' }} >
													<span class="checkmark1"></span>
													<a class="subcategory {{ str_replace(' ', '-', $categories->subcategories->slug) == $slug ? 'actv' : '' }}" href="{{ route('productBySubCategory',['slug' => str_replace(' ', '-', $categories->subcategories->slug)]) }}" style="text-decoration:none;color:grey" data-subcategory="{{ str_replace(' ', '-', $categories->subcategories->slug) }}" >
														{{ $categories->subcategories->subcategory ?? ''}}
													</a>
												</label>
												@endif
											@endforeach
										@endif		
									</div>
									@endif
								@endforeach
							@endif	
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
											<input type="checkbox" name="brand[]" class="brand {{ $brand->id ? 'brand_'.$brand->id : '' }}" data-brand="{{ $brand->id ?? ''}}" onclick="getProduct( this,'brand', '{{ $brand->id }}')" <?php if(in_array($brand->id, $brandCheck)){ echo 'checked'; }else{ echo ''; }?>>
											<span class="checkmark"></span>{{ $brand->brand ?? ''}}
										</label>
										@endif
									@endforeach
								@endif		
							</div>
						</div>
					</div>
					<div class="mobile-filter-tab"> 
						<!-- <div class="scroll-max-width"> -->
							<span id="service_type">Brand</span>
							<!-- <span>Category</span>
							<span>Brand</span> -->
						<!-- </div> -->
					</div>
					<div class="aside-mobile-filter">
						<span class="m-filter-close">X</span>
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
											<input type="checkbox" name="brand[]" class="brand {{ $brand->id ? 'brand_'.$brand->id : '' }}" data-brand="{{ $brand->id ?? ''}}" onclick="getProduct( this,'brand', '{{ $brand->id }}')" >
											<span class="checkmark"></span>{{ $brand->brand ?? ''}}
										</label>
										@endif
									@endforeach
								@endif	
							</div>						
						</div>
					</div>
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
							<select class="form-select-sm rounded-0 order" onChange="getProduct( this,'order' )">
								<option value = "ASC" <?php echo ( ( isset($orderCheck) && $orderCheck == 'ASC' ) ? 'selected' : '' );?> >Price Low to High</option>
								<option value = "DESC" <?php echo ( ( isset($orderCheck) && $orderCheck = 'DESC' ) ? 'selected' : '' );?>>Price High to Low</option>
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
										<ins>Rs. {{ $price ?? ''}}</ins>
										<del>{{ $product->price ?? ''}}</del>
									</p>
									<div class="add-to-cart">
										<a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $product->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
									</div>
								</div>
							</div>
							@endif
						@endforeach
					@endif
					<br>
					<div class="text-center" id="links" ><span>{{ $products->links() }}</span></div>
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
	function getProduct(thiss, label, idd="ASC"){
    	//$('.brand').click(function(e){ 
		var brand = order = '';	
		if(label == 'brand'){	
			var attr = $(thiss).attr('checked');
			
			if (typeof attr !== 'undefined' && attr !== false) {
				$(thiss).removeAttr('checked')
				$(thiss).prop('checked',false)
			}else{
				$(thiss).attr('checked','checked')
				$(thiss).prop('checked',true)
			}
		}

		order = $('.order').val();
		if(label == 'order'){	
			order = $(thiss).val()
		}	

		$(".brand").each(function() {
			var attr = $(this).attr('checked');
			if (typeof attr !== 'undefined' && attr !== false) {
				var data = $(this).data('brand');
				brand = brand+','+data
			}
		});
		brand = brand.replace(/(^,)|(,$)/g, "");
		if(brand != ''){
			brand = brand +'/';
		}
		var subcat = '';
		$(".subcategory").each(function() {
			var cls = $(this).hasClass('actv');
			if(cls == true){
				var subcategory = $(this).data('subcategory');
				subcat = $('.' + subcategory).val();
			}
		});
		if(subcat == '' || subcat == null){
			$(".category").each(function() {
				var cls = $(this).hasClass('actv');
				if(cls == true){
					var category = $(this).data('category');
					subcat = category;
				}
			});
		}	

        // Fake api for making post requests
        fetch( "{{ url('productByBrand') }}/" +subcat+ '/' + brand + order) 
		.then(res => res.text())
		.then(html => {
			document.getElementById("add_item").innerHTML = '';
			document.getElementById("add_item").innerHTML = html;
		})
		window.history.pushState( {}, "", "{{ url('productByBrand') }}/" +subcat+ '/' + brand + order + '?page=1' );
		//.catch(error => {console.log(error)});
    }
</script>
@endsection	

