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