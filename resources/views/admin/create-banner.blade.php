@extends('admin.layouts.app',['page_title' => 'Banner','action_title' => 'Banners','page_action' => route('banners'),'manage'=>'Products','manage_action' => route('products')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-banner')}}" enctype="multipart/form-data">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
        <div class="row" id="product-form">
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Banner name</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('type') has-error @enderror">
                <select id="" name="type"  class="form-control input-border-bottom" required title="Banner placement">
                    <option></option>
                    <option value="main">Main</option>
                    <option value="popular">Popular</option>
                    <option value="featured">Featured Brands</option>
                    <option value="bottom">Shop by Health Concerns</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Banner Type</label>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror">
                <textarea name="description"   class="form-control input-border-bottom @error('name')  @enderror" >{{old('description')}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group form-floating-label @error('status') has-error @enderror">
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
                    <button type="button" class="btn btn-secondary" onclick="fetchImageForm('{{route('get-banner-image-form')}}')">
                        <span class="btn-label"><i class="fa fa-plus"></i></span>Image
                    </button>
                </div>
                <!-- banner images -->
                <div id="banner-image">

                </div>
                <!-- banner images -->
            </div>
        </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('banners')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
<script src="{{URL::asset('assets/admin/js/banner.js')}}"></script>
@endsection