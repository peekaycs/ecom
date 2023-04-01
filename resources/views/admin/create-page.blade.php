@extends('admin.layouts.app',['page_title' => 'Pages','action_title' => 'Pages','page_action' => route('pages')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-page')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom " required>
                <label for="inputFloatingLabel" class="placeholder">Page name</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
           
            <div class="form-group form-floating-label @error('slug') has-error @enderror">
                <input id="" name="slug" value="{{old('slug')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Slug</label>
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('title') has-error @enderror">
                <input id="" name="title" value="{{old('title')}}" type="text"  class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Page Title</label>
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('meta_keywords') has-error @enderror">
                <input id="" name="meta_keywords" value="{{old('meta_keywords')}}" type="text"  class="form-control input-border-bottom" >
                <label for="inputFloatingLabel" class="placeholder">Meta Keywords</label>
                @error('meta_keywords')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="form-group form-floating-label @error('content') has-error @enderror">
                        <label for="inputFloatingLabel" >Page Content</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="form-group form-floating-label @error('content') has-error @enderror">
                        <textarea name="content"  id="content" class="form-control input-border-bottom @error('name')  @enderror" >{{old('content')}}</textarea>
                    </div>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group form-floating-label @error('published') has-error @enderror">
                <select class="form-control input-border-bottom" name="published" id="published" required>
                    <option value=""></option>
                    <option value="1">Publish</option>
                    <option value="0">Unpublish</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Published</label>
                @error('published')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('pages')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<style>
.ck-editor__editable_inline {
    min-height: 400px;
}
</style>
@endsection
