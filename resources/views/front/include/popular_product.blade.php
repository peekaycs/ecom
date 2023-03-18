<section class="slide-section mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Popular Healthcare Products</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="nav nav-pills float-end">
                        <li class="nav-item">
                            <a class="active" data-bs-toggle="pill" href="#Latest_Products">Latest Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-bs-toggle="pill" href="#Top_Rating_Products">Top Rating Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-bs-toggle="pill" href="#Featured_Products">Featured Products</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">                
                    <div class="tab-content">
                        <div id="Latest_Products" class="tab-pane active">
                            <div class="product-slide">
                                @foreach($best_selling as $best) 
                                <div class="product-box">
                                    <span class="product-offer">-16%</span>
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset('assets/front/images/b1.jpg')}}" alt="">
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
                                @endforeach
                                <!--<div class="product-box">
                                    <span class="product-offer">-16%</span>
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset('assets/front/images/b1.jpg')}}" alt="">
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
                                <div class="product-box">
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset('assets/front/images/b2.jpg')}}" alt="">
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
                                        <img src="{{URL::asset('assets/front/images/b3.jpg')}}" alt="">
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
                                        <img src="{{URL::asset('assets/front/images/b4.jpg')}}" alt="">
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
                                        <img src="{{URL::asset('assets/front/images/b5.jpg')}}" alt="">
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
                                        <img src="{{URL::asset('assets/front/images/b3.jpg')}}" alt="">
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
                            </div>
                        </div>
                        <div id="Top_Rating_Products" class="tab-pane fade">
                            
                        </div>
                        <div id="Featured_Products" class="tab-pane fade">
                            
                        </div>		
                    </div>
                </div>
            </div>
        </div>
    </section>