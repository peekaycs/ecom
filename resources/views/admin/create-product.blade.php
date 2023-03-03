@extends('admin.layouts.app',['page_title' => 'Product','action_title' => 'Products','page_action' => route('products')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-product')}}" enctype="multipart/form-data">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            <div class="row" id="product-form">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group form-floating-label  @error('product') has-error @enderror">
                        <input id="" name="product" value="{{old('product')}}" type="text" class="form-control input-border-bottom" required>
                        <label for="inputFloatingLabel" class="placeholder">Product Name</label>
                        @error('product')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label  @error('slug') has-error @enderror">
                        <input id="" name="slug" value="{{old('slug')}}" type="text" class="form-control input-border-bottom" required>
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
                                <option value="{{$category->uuid}}" {{old('category_id') == $category->uuid  ? "selected" :""}}>{{$category->category}}</option>
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
                                <option value="{{$subCategory->uuid}}" {{old('subcategory_id') == $category->uuid  ? "selected" :""}}>{{$subCategory->subcategory}}</option>
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
                        <input type="text" class="form-control input-border-bottom" name="sku" id="sku" required>
                        <label for="selectFloatingLabel" class="placeholder">SKU</label>
                        @error('sku')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('quantity') has-error @enderror">
                        <input type="number" class="form-control input-border-bottom" name="quantity" id="quantity" step=1 required>
                        <label for="selectFloatingLabel" class="placeholder">Quantity</label>
                        @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('price') has-error @enderror">
                        <input type="number" class="form-control input-border-bottom" name="price" id="price" min=0 step=0.01 required>
                        <label for="selectFloatingLabel" class="placeholder">Unit Price</label>
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('discount') has-error @enderror">
                        <input type="number" class="form-control input-border-bottom" name="discount" min=0 id="discount" step=0.01 required>
                        <label for="selectFloatingLabel" class="placeholder">Discount</label>
                        @error('discount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label @error('short_description') has-error @enderror">
                        <input type="text" class="form-control input-border-bottom" name="short_description" id="short_description" required>
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
                        <input type="number" class="form-control input-border-bottom" name="order" min=0 step=1 id="order" required>
                        <label for="selectFloatingLabel" class="placeholder">Order</label>
                        @error('order')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('image') has-error @enderror">
                    <label for="exampleFormControlFile" class="placeholder">Product Main Image</label>
                        <input type="file" class="form-control input-border-bottom" name="image" id="image" required>
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label">
                        <select class="form-control input-border-bottom" name="status" id="status" required>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        <label for="selectFloatingLabel" class="placeholder">Status</label>
                        @error('status')
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
<script>
    function fetchAttributeForm(url){
        fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById("attribute-form").insertAdjacentHTML('beforeend',html);
        })
        .catch(error => {console.log(error)});
    }

    function fetchAttributeOptions(element){
        let url = element.options[element.selectedIndex].getAttribute('href');;
        fetch(url)
        .then( response => response.text())
        .then( html => {
          let node =  document.querySelectorAll('.dynamic-attribute');
          for(let i  of  node){
            if(i.childNodes.length == 3){
                i.insertAdjacentHTML('beforeend',html);
            }
          }
        }).catch( error => {console.log(error)});
    }

</script>
@endsection