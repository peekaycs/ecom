@extends('admin.layouts.app',['page_title' => 'Sub Category','action_title' => 'Sub Categories','page_action' => route('subcategories')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-subcategory')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            
            <div class="form-group form-floating-label @error('categorry') has-error @enderror ">
                <select id="" name="category"  class="form-control input-border-bottom" required>
                    <option value=""></option>
                    @foreach($categories as $category)
                        <option value="{{ $category->uuid }}" {{ old('category') ? "selected" :''}}>{{$category->category}}</option>
                    @endforeach
                </select>
                <label for="inputFloatingLabel" class="placeholder">Category</label>
                @error('category')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('subcategory') has-error  @enderror ">
                <input id="" name="subcategory" value="{{old('subcategory')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Sub Category</label>
                @error('subcategory')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('slug') has-error  @enderror">
                <input id="" name="slug" value="{{old('slug')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Slug</label>
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror ">
                <textarea id="" name="description"   class="form-control input-border-bottom" required>{{old('description')}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('order') has-error @enderror ">
                <input id="" name="order" value="{{old('order')}}" type="number" min="0" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Order</label>
                @error('order')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('visibility') has-error @enderror ">
                <select class="form-control input-border-bottom" name="visibility" id="visibility" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Show in menu</label>
                @error('status')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('status') has-error @enderror ">
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
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('categories')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection