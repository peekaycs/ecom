@extends('admin.layouts.app',['page_title' => 'Brands','action_title' => 'Brands','page_action' => route('brands')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-brand',$brand->id)}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('brand') has-error @enderror">
                <input id="" name="brand" value="{{old('brand') ? old('brand') : ($brand->brand ?? '')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Brand</label>
                @error('brand')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror">
                <textarea name="description"   class="form-control input-border-bottom @error('name')  @enderror" >{{old('description') ?? ($brand->description ?? '')}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('order') has-error @enderror">
            <input id="" name="order"  value="{{old('order') ?? ($brand->order ?? '')}}" type="number" min="0" class="form-control input-border-bottom " required>
                <label for="selectFloatingLabel" class="placeholder">Order</label>
                @error('order')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('status') has-error @enderror">
                <select class="form-control input-border-bottom" name="status" id="status" required>
                    <option value="1" {{ (old('status') && old('status') == '1') ? "selected" : ($brand->status == '1' ? "selected" : "")}}>Enable</option>
                    <option value="0" {{ (old('status') && old('status') == '0') ? "selected" : ($brand->status == '0' ? "selected" : "")}}>Disable</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Status</label>
                @error('status')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('brands')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection 