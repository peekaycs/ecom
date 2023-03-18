@extends('front.layouts.app')

@section('content')
    <section class="best-selling-products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                    <div class="text-end">
                        <span class="text-danger fw-bold">Must Have</span>
                        <h4>Best Selling Products</h4>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                    <div class="best-selling-products-slide">
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a1.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a5.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a1.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="images/a4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="best-selling-box">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/a5.jpg')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="offer-box">
                        <a href="javascript:void(0)">
                            <img src="{{URL::asset('assets/front/images/offer1.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="offer-box">
                        <a href="javascript:void(0)">
                            <img src="{{URL::asset('assets/front/images/offer2.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="offer-box">
                        <a href="javascript:void(0)">
                            <img src="{{URL::asset('assets/front/images/offer3.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                </div>	
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
    <section class="slide-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Featured Brands</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="featured-brand-slide">
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p1.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p2.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p3.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p4.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)"  class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p5.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p2.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>
                        <div class="product-box">
                            <a href="javascript:void(0)" class="text-center">
                                <span class="zoomimg">
                                    <img src="{{URL::asset('assets/front/images/p4.jpg')}}" alt="" class="circle">
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="text-center">
                                <h5 class="product-name">Stethoscope</h5>
                                <span class="offer-btn">up to 50% off</span>
                            </a>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product-cat-section mt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Shop by Health Concerns</h4>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-1.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Depression</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-2.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Hair Loss</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-3.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Magraine & Headache</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="product-cat-box">
                        <div class="product-cat-image">
                            <a href="javascript:void(0)">
                                <img src="{{URL::asset('assets/front/images/cat-4.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="product-cat-details">
                            <h4>
                                <a href="javascript:void(0)">Stomach Pain</a>
                            </h5>
                            <a href="javascript:void(0)" class="shop-now">shop now</a>                        
                        </div>                    
                    </div>
                </div>            
            </div>
        </div>
    </section>

    <section class="trustBarWrap-section">
        <div class="container">
            <div class="row y-3">			
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="trust-box">
                        <div class="trust-img">
                            <img src="{{URL::asset('assets/front/images/free-delivery.png')}}" alt="">
                        </div>
                        <div class="trust-details">
                            <h6>Free Shipping</h6>
                            <p>On orders over Rs. 500</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="trust-box">
                        <div class="trust-img">
                            <img src="{{URL::asset('assets/front/images/treat.png')}}" alt="">
                        </div>
                        <div class="trust-details">
                            <h6>Free Treat</h6>
                            <p>Included every order</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="trust-box">
                        <div class="trust-img">
                            <img src="{{URL::asset('assets/front/images/credit-card.png')}}" alt="">
                        </div>
                        <div class="trust-details">
                            <h6>Shop With Confidence</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="trust-box">
                        <div class="trust-img">
                            <img src="{{URL::asset('assets/front/images/online-chat.png')}}" alt="">
                        </div>
                        <div class="trust-details">
                            <h6>Friendly Services</h6>
                            <p>Dedicated 24x7 support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advantage-section">
        <div class="container">
            <h4 class="text-center heading">
                <span>Why Pick Homeopathy Medicine Recommended Alternatives </span>				
            </h4>
            <div class="row mt-2 g-3">			
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv1.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv2.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv3.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv4.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv5.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="common-box">
                        <div class="advantage-img">
                            <img src="{{URL::asset('assets/front/images/adv6.jpg')}}" alt="">
                        </div>
                        <div class="advantage-box">
                            <p>is provided by us for all car services that you book through our platform</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


