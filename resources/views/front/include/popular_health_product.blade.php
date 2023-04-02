<section class="slide-section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h4 class="heading">Popular Healthcare Products</h4>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="product-slide">
                    @if (isset($popular_health) && !empty($popular_health))
                        @foreach($popular_health as $popular) 
                            @if (isset($popular) && !empty($popular))
                            <div class="product-box">
                                <span class="product-offer">-{{ $popular->discount ?? '' }}%</span>
                                <a href="javascript:void(0)" class="text-center">
                                    <img src="{{ URL::asset($popular->image) ?? '' }}" alt="">
                                </a>
                                <div class="categories-name">
                                    <a href="javascript:void(0)">{{ $popular->category->category ?? '' }}</a>
                                    <a href="javascript:void(0)">{{ $popular->subcategory->subcategory ?? '' }}</a>
                                </div>
                                <a href="javascript:void(0)">
                                    <h5 class="product-name">
                                        {{ $popular->product ?? '' }} 
                                        {{ (isset($popular->productAttribute[0]->attribute->name)) ? ' - '.$popular->productAttribute[0]->attribute->name : '' }}
                                    </h5>
                                </a>
                                <?php //dd($popular->productAttribute[0]->attribute->name);?> 
                                <p class="item-price">                                    
                                    <?php $price = $popular->price - (($popular->price * $popular->discount) / 100); ?>                               
                                    <ins>{{ $price ?? '' }}</ins>
                                    <del>{{ $popular->price ?? '' }}</del>
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
                                    <a href="{{ route('product_detail',['slug' => str_replace(' ', '-', $popular->slug)]) }}" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>
                            <!--<div class="product-box">
                                <a href="javascript:void(0)" class="text-center">
                                    <img src="images/b2.jpg" alt="">
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
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star-half-alt"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>
                            <div class="product-box">
                                <a href="javascript:void(0)" class="text-center">
                                    <img src="images/b3.jpg" alt="">
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
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star-half-alt"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>
                            <div class="product-box">
                                <a href="javascript:void(0)" class="text-center">
                                    <img src="images/b4.jpg" alt="">
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
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star-half-alt"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>
                            <div class="product-box">
                                <a href="javascript:void(0)" class="text-center">
                                    <img src="images/b5.jpg" alt="">
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
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star-half-alt"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>
                            <div class="product-box">
                                <a href="javascript:void(0)">
                                    <img src="images/b3.jpg" alt="">
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
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star-half-alt"></i></li>
                                </ul>
                                <div class="add-to-cart">
                                    <a href="javascript:void(0)" class="btn-sm btn-outlinr-danger">Add to Cart</a>
                                </div>
                            </div>-->
                            @endif
                        @endforeach
                    @endif	
                </div>
            </div>
        </div>
    </div>
</section>