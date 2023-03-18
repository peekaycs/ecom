@extends('admin.layouts.app',['page_title' => 'Banner','action_title' => 'Banners','page_action' => route('banners'),'manage'=>'Products','manage_action' => route('products')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-banner', $banner->id)}}" enctype="multipart/form-data">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
        <div class="row" id="product-form">
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input value="{{$banner->name}}" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Banner name</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('type') has-error @enderror">
                <select id="" name="type"  class="form-control input-border-bottom" required title="Banner placement">
                    <option></option>
                    <option value="main" {{old('type') ?? ($banner->type == 'main' ? 'selected' : '')}}>Main</option>
                    <option value="popular" {{old('type') ?? ($banner->type == 'popular' ? 'selected' : '')}}>Popular</option>
                    <option value="featured" {{old('type') ?? ($banner->type == 'featured' ? 'selected' : '')}}>Featured</option>
                    <option value="bottom" {{old('type') ?? ($banner->type == 'bottom' ? 'selected' : '')}}>Bottom Banner</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Banner Type</label>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror">
                <textarea name="description"   class="form-control input-border-bottom @error('name')  @enderror" >{{old('description') ?? $banner->description }}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group form-floating-label @error('status') has-error @enderror">
                <select class="form-control input-border-bottom" name="status" id="status" required>
                    <option value="1" {{old('status') == '1' ? 'selected' : ($banner->getOriginal('status') == 1 ? 'selected' : '')}}>Enable</option>
                    <option value="0" {{old('status') == '0' ? 'selected' : ($banner->getOriginal('status') == 0 ? 'selected' : '')}}>Disable</option>
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
                @foreach($banner->bannerImages as $bannerImage)
                    <div class="form-group d-flex @error('images') has-error @enderror" >
                        <div class="col-md-3">
                            <label for="exampleFormControlFile" class="placeholder">Image</label>
                            <input type="file" class="form-control input-border-bottom" name="images[]" >
                            <input type="hidden" name="old_image[]" value="{{$bannerImage->id ?? 0}}">
                            @error('images')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="imagecheck mb-4">
                                <figure class="imagecheck-figure">
                                    <img src="{{url($bannerImage->image ?? '')}}" alt="title" class="imagecheck-image">
                                </figure>
                            </label>
                        </div>
                    </div>
                    <div class="form-group @error('title') has-error @enderror">
                    <label for="exampleFormControlFile" class="placeholder">Title</label>
                        <input type="text" class="form-control input-border-bottom" name="title[]" value="{{$bannerImage->title}}" >
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('link') has-error @enderror">
                    <label for="exampleFormControlFile" class="placeholder">Banner Link</label>
                        <input type="url" class="form-control input-border-bottom" name="link[]" value="{{$bannerImage->link
                        }}"  >
                        @error('link')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group" style="border-bottom: 2px solid #000;"></div>
                    @endforeach
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