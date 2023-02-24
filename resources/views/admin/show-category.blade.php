@extends('admin.layouts.app',['page_title' => 'Category','action_title' => 'Categories','page_action' => route('categories')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-category')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            <div class="form-group form-floating-label has-error">
                <input id="" name="category" value="{{old('category') ? old('category') : $category->category}}" type="text" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Category</label>
                @error('category')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label has-error">
                <input id="" name="slug" value="{{old('slug')}}" type="text" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Slug</label>
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label has-error">
                <textarea id="" name="description"   class="form-control input-border-bottom @error('name')  @enderror" required>{{old('description')}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label has-error">
                <input id="" name="order" value="{{old('order')}}" type="number" min="0" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Order</label>
                @error('order')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <select class="form-control input-border-bottom" name="visibility" id="visibility" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Show in menu</label>
                @error('status')
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
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('categories')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection