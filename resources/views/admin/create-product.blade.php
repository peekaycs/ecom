@extends('admin.layouts.app',['page_title' => 'Product','action_title' => 'Products','page_action' => route('products')])

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row" id="">
                <div class="container">  
                    <!--<a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>  
                    <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>  
                    <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>-->  
                    <span><strong>Bulk Upload Product</stropng></span>
                    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('bulkUpload') }}" class="form-horizontal" method="post" enctype="multipart/form-data">  
                        @csrf
                        <input type="file" name="import_file" />  
                        @error('import_file')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button class="btn btn-primary">Import File</button>  
                    </form> 
                     
                </div>  
            </div>
        </div>        
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
                        <div class="form-group form-floating-label @error('brand_id') has-error @enderror">
                            <select class="form-control input-border-bottom" name="brand_id" id="brand_id" >
                                <option value=""></option>
                                @forelse($brands as $brand)
                                    <option value="{{$brand->id}}" @if(old('brand_id') == $brand->id) selected @endif>{{$brand->brand}}</option>
                                @empty
                                    <option value="">Please create brand</option>
                                @endforelse
                            </select>
                            <label for="selectFloatingLabel" style="top:0px" class="placeholder">Brand</label>
                            @error('brand_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Category -->
                        <div class="form-group form-floating-label @error('category_id') has-error @enderror">
                            <select class="form-control input-border-bottom" name="category_id" id="category_id" onchange="getSubcategories(this.value)" required>
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
                            </select>
                            <label for="selectFloatingLabel" style="top:0px" class="placeholder">Sub Category</label>
                            @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End of Sub category -->
                        <div class="form-group form-floating-label @error('sku') has-error @enderror">
                            <input type="text" class="form-control input-border-bottom" name="sku" id="sku" value="{{old('sku')}}" required>
                            <label for="selectFloatingLabel" class="placeholder">SKU</label>
                            @error('sku')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('quantity') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" name="quantity" value="{{old('quantity')}}" id="quantity" step=1 required>
                            <label for="selectFloatingLabel" class="placeholder">Quantity</label>
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('price') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" name="price" value="{{old('price')}}" id="price" min=0 step=0.01 required>
                            <label for="selectFloatingLabel" class="placeholder">Unit Price</label>
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('discount') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" value="{{old('discount')}}" name="discount" min=0 id="discount" step=0.01 >
                            <label for="selectFloatingLabel" class="placeholder">Discount</label>
                            @error('discount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('comission') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" name="comission" value="{{old('comission')}}" min=0 id="comission" step=0.01 >
                            <label for="selectFloatingLabel" class="placeholder">Commission</label>
                            @error('comission')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('shipping_cost') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" value="{{old('shipping_cost')}}" name="shipping_cost" min=0 id="shipping_cost" step=0.01 >
                            <label for="selectFloatingLabel" class="placeholder">Shipping Cost</label>
                            @error('shipping_cost')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('short_description') has-error @enderror">
                            <input type="text" class="form-control input-border-bottom" name="short_description" value="{{old('short_description')}}"id="short_description" required>
                            <label for="selectFloatingLabel" class="placeholder">Short Description</label>
                            @error('short_description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="form-group form-floating-label @error('content') has-error @enderror">
                                    <label for="inputFloatingLabel" >Description</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-floating-label @error('short_description') has-error @enderror">
                            <textarea  class="form-control input-border-bottom" name="description" id="description" required>
                            {{old('description')}}
                            </textarea>
                            <!-- <label for="selectFloatingLabel" class="placeholder">Description</label> -->
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('featured') has-error @enderror">
                        <select class="form-control input-border-bottom" name="featured" id="featured" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label for="selectFloatingLabel" class="placeholder">Featured</label>
                            @error('featured')value="{{old('short_description')}}"
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group form-floating-label @error('order') has-error @enderror">
                            <input type="number" class="form-control input-border-bottom" value="{{old('order')}}" name="order" min=0 step=1 id="order" required>
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
                            <select class="form-control input-border-bottom" name="published" id="published" required>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<style>
.ck-editor__editable_inline {
    min-height: 400px;
}
</style>
<script src="{{URL::asset('assets/admin/js/product.js')}}"></script>
@endsection