@extends('admin.layouts.app',['page_title' => 'Product','action_title' => 'Products','page_action' => route('products'),'manage'=>'Products','manage_action'=>route('products')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-product',$product->id)}}" enctype="multipart/form-data">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            <div class="row" id="product-form">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group form-floating-label  @error('product') has-error @enderror">
                        <input id="" name="product" value="{{old('product') ? old('product') : ($product->product ? $product->product:'')}}" type="text" class="form-control input-border-bottom" required>
                        <label for="inputFloatingLabel" class="placeholder">Product Name</label>
                        @error('product')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label  @error('slug') has-error @enderror">
                        <input id="" name="slug" value="{{old('slug') ? old('slug') : ($product->slug ? $product->slug: '')}}" type="text" class="form-control input-border-bottom" required>
                        <label for="inputFloatingLabel" class="placeholder">Slug</label>
                        @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Category -->
                    <div class="form-group form-floating-label @error('category_id') has-error @enderror">
                        <select class="form-control input-border-bottom" name="category_id" id="category_id" required>
                            <option value=""></option>
                            @forelse($categories as $category)
                                <option value="{{$category->uuid}}" {{old('category_id') == $category->uuid  ? "selected" :($product->category_id == $category->uuid ? "selected" : '') }}>{{$category->category}}</option>
                            @empty
                                <option value="">Please create category</option>
                            @endforelse
                        </select>
                        <label for="selectFloatingLabel" style="top:0px" class="placeholder">Category</label>
                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Category -->
                    <!-- Sub Category -->
                    <div class="form-group form-floating-label @error('category_id') has-error @enderror">
                        <select class="form-control input-border-bottom" name="subcategory_id" id="subcategory_id" required>
                            <option value=""></option>
                            @forelse($subCategories as $subCategory)
                                <option value="{{$subCategory->uuid}}" {{old('subcategory_id') == $subCategory->uuid  ? "selected" : ($product->subcategory_id == $subCategory->uuid ? 'selected' : '')}}>{{$subCategory->subcategory}}</option>
                            @empty
                                <option value="">Please create category</option>
                            @endforelse
                        </select>
                        <label for="selectFloatingLabel" style="top:0px" class="placeholder">Sub Category</label>
                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End of Sub category -->
                    <div class="form-group form-floating-label @error('sku') has-error @enderror">
                        <input type="text" value="{{old('sku') ? old('sku') : ($product->sku ?? '')}}" class="form-control input-border-bottom" name="sku" id="sku" required>
                        <label for="selectFloatingLabel" class="placeholder">SKU</label>
                        @error('sku')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('quantity') has-error @enderror">
                        <input type="number" value="{{old('quantity') ? old('quantity') : ($product->quantity ?? '')}}" class="form-control input-border-bottom" name="quantity" id="quantity" step=1 required>
                        <label for="selectFloatingLabel" class="placeholder">Quantity</label>
                        @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('price') has-error @enderror">
                        <input type="number" value="{{old('price') ? old('price') : ($product->price ?? '')}}" class="form-control input-border-bottom" name="price" id="price" min=0 step=0.01 required>
                        <label for="selectFloatingLabel" class="placeholder">Unit Price</label>
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('discount') has-error @enderror">
                        <input type="number" value="{{old('discount') ? old('discount') : ($product->discount ?? '')}}" class="form-control input-border-bottom" name="discount" min=0 id="discount" step=0.01 required>
                        <label for="selectFloatingLabel" class="placeholder">Discount</label>
                        @error('discount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('short_description') has-error @enderror">
                        <input type="text" value="{{old('short_description') ? old('short_description') : ($product->short_description ?? '')}}" class="form-control input-border-bottom" name="short_description" id="short_description" required>
                        <label for="selectFloatingLabel" class="placeholder">Short Description</label>
                        @error('short_description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('featured') has-error @enderror">
                    <select class="form-control input-border-bottom" name="featured" id="featured" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label for="selectFloatingLabel" class="placeholder">Featured</label>
                        @error('featured')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('order') has-error @enderror">
                        <input type="number" value="{{old('order') ? old('order') : ($product->order ?? '')}}" class="form-control input-border-bottom" name="order" min=0 step=1 id="order" required>
                        <label for="selectFloatingLabel" class="placeholder">Order</label>
                        @error('order')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group d-flex @error('image') has-error @enderror" >
                    
                        <div class="col-md-3">
                        <label for="exampleFormControlFile" class="placeholder">Product Main Image</label>
                            <input type="file" class="form-control input-border-bottom" name="image" id="image" >
                            <input type="hidden" value="{{$product->image ?? ''}}" class="" name="old_image">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                       
                       
                        <div class="col-md-3">
                            <label class="imagecheck mb-4">
                                <figure class="imagecheck-figure">
                                    <img src="{{url($product->image)}}" alt="title" class="imagecheck-image">
                                </figure>
                            </label>
                        </div>
                    </div>
                    <div class="form-group form-floating-label">
                        <select class="form-control input-border-bottom" name="published" id="published" required>
                            <option value="1" {{(old('published') && old('published') == 1) ? "selected" : (($product->published && $product->published == 1) ? "selected" : "")}}>Enable</option>
                            <option value="0"{{(old('published') && old('published') == 0) ? "selected" : (($product->published && $product->published == 0) ? "selected" : "")}}>Disable</option>
                        </select>
                        <label for="selectFloatingLabel" class="placeholder">Status</label>
                        @error('published')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group form-floating-label  @error('attribute_group') has-error @enderror">
                        <button type="button" class="btn btn-secondary" onclick="fetchAttributeForm('{{route('get-attribute-form')}}')">
                            <span class="btn-label"><i class="fa fa-plus"></i></span>Attributes
                        </button>
                    </div>
                    <!-- Attributes -->
                    <div id="attribute-form">
                        @foreach($productAttributes as $productAttribute)
                        <div class="form-group form-floating-label  @error('attribute') has-error @enderror">
                                <select id="" name="attribute_group_id[]"   class="form-control input-border-bottom" onchange="fetchAttributeOptions(this)" required>
                                    <option value=""></option>
                                    @foreach($attributeGroups as $attributeGroup)
                                        <option value="{{$attributeGroup->id}}" {{($attributeGroup->id == $productAttribute->attribute_group_id) ? "selected" :""}} href="{{route('get-attribute-options',$attributeGroup->id)}}">{{$attributeGroup->name}}</option>
                                    @endforeach
                                </select>
                                <label for="inputFloatingLabel" class="placeholder">Attribute Group</label>
                                @error('attribute_group')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group form-floating-label  @error('attribute') has-error @enderror">
                                <select  name="attribute[]"  class="form-control input-border-bottom dynamic-attribute" required>
                                    @foreach($attributes as $attribute)
                                        @if($attribute->id == $productAttribute->attribute_id)
                                            <option value="{{$attribute->id}}" selected>{{$attribute->name}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                                <label for="inputFloatingLabel" class="placeholder">Attribute</label>
                                @error('attribute')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group form-floating-label @error('attribute_price') has-error @enderror">
                                <input type="number" value="{{$productAttribute->price}}" class="form-control input-border-bottom" name="attribute_price[]" id="attribute_price" min=0 step=.01 required>
                                <label for="inputFloatingLabel" class="placeholder">Attribute Price</label>
                                @error('attribute_price')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group form-floating-label @error('attribute_discount') has-error @enderror">
                                <input type="number" value="{{$productAttribute->discount}}" class="form-control input-border-bottom" name="attribute_discount[]" id="attribute_discount" min=0 step=.01 required>
                                <label for="inputFloatingLabel" class="placeholder">Attribute discount</label>
                                @error('attribute_discount')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group form-floating-label @error('attribute_order') has-error @enderror">
                                <input type="number" value="{{$productAttribute->order}}" class="form-control input-border-bottom" name="attribute_order[]" id="attribute_order" min=0 step=1 required>
                                <label for="inputFloatingLabel" class="placeholder">Attribute Order</label>
                                @error('attribute_order')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group d-flex @error('attribute_images') has-error @enderror" >
                                <div class="col-md-3">
                                    <label for="exampleFormControlFile" class="placeholder">Attribute Image</label>
                                    <input type="file" class="form-control input-border-bottom" name="attribute_images[]" id="attribute_images"  >
                                    <input type="hidden" name="old_attribute_image[]" value="{{$productAttribute->productAttributeImage[0]->uuid ?? 0}}">
                                    @error('attribute_images')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="imagecheck mb-4">
                                        <figure class="imagecheck-figure">
                                            <img src="{{url($productAttribute->productAttributeImage[0]->image ?? '')}}" alt="title" class="imagecheck-image">
                                        </figure>
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="old_attribute[]" value="{{$productAttribute->id}}">
                            <div class="form-group" style="border-bottom: 2px solid #000;"></div>
                        @endforeach
                    </div>
                    <!-- Attributes -->
                </div>
               
            </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('attribute-groups')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
<script src="{{URL::asset('assets/admin/js/product.js')}}"></script>
@endsection