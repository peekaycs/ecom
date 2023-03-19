<section class="slide-section mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h4 class="heading">Popular Healthcare Products</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="nav nav-pills float-end">
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
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">                
                    <div class="tab-content">
                        <div id="Latest_Products" class="tab-pane active">
                            <div class="product-slide">
                                @foreach($best_selling as $best) 
                                <div class="product-box">
                                    <span class="product-offer">-{{$best->discount}}%</span>
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset($best->image)}}" alt="">
                                    </a>
                                    <div class="categories-name">
                                        <a href="javascript:void(0)">{{$best->category->category}}</a>
                                        <a href="javascript:void(0)">{{$best->subcategory->subcategory}}</a>
                                    </div>
                                    <a href="javascript:void(0)">
                                        <h5 class="product-name">{{$best->product}} – 10mL</h5>
                                    </a>
                                    <p class="item-price">     
                                        <?php $price = $best->price - (($best->price * $best->discount) / 100); ?>                               
                                        <ins>{{$price}}</ins>
                                        <del>{{$best->price}}</del>
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
                            </div>
                        </div>
                        <div id="Top_Rating_Products" class="tab-pane fade">
                            <div class="product-slide">
                                @foreach($best_selling as $top_rated) 
                                <div class="product-box">
                                    <span class="product-offer">-{{$top_rated->discount}}%</span>
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset($best->image)}}" alt="">
                                    </a>
                                    <div class="categories-name">
                                        <a href="javascript:void(0)">{{$top_rated->category->category}}</a>
                                        <a href="javascript:void(0)">{{$top_rated->subcategory->subcategory}}</a>
                                    </div>
                                    <a href="javascript:void(0)">
                                        <h5 class="product-name">{{$top_rated->product}} – 10mL</h5>
                                    </a>
                                    <p class="item-price">     
                                        <?php $price = $top_rated->price - (($top_rated->price * $top_rated->discount) / 100); ?>                               
                                        <ins>{{$price}}</ins>
                                        <del>{{$top_rated->price}}</del>
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
                            </div>
                        </div>
                        <div id="Featured_Products" class="tab-pane fade">
                            <div class="product-slide">
                                @foreach($best_selling as $featured) 
                                <div class="product-box">
                                    <span class="product-offer">-{{$featured->discount}}%</span>
                                    <a href="javascript:void(0)" class="text-center">
                                        <img src="{{URL::asset($best->image)}}" alt="">
                                    </a>
                                    <div class="categories-name">
                                        <a href="javascript:void(0)">{{$featured->category->category}}</a>
                                        <a href="javascript:void(0)">{{$featured->subcategory->subcategory}}</a>
                                    </div>
                                    <a href="javascript:void(0)">
                                        <h5 class="product-name">{{$featured->product}} – 10mL</h5>
                                    </a>
                                    <p class="item-price">     
                                        <?php $price = $featured->price - (($featured->price * $featured->discount) / 100); ?>                               
                                        <ins>{{$price}}</ins>
                                        <del>{{$featured->price}}</del>
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
                            </div>
                        <div>    	
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