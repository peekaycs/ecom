@extends('admin.layouts.app',['page_title' => 'Attributes','page_action' => route('attributes')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-attribute')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            <div class="form-group form-floating-label has-error">
                <input id="" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Attribute</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <select class="form-control input-border-bottom" name="group_id" id="group_id" required>
                    <option value="">Select</option>
                    @forelse($attributeGroups as $attributeGroup)
                        <option value="{{$attributeGroup->id}}" {{old('group_id') == $attributeGroup->id  ? "selected" :""}}>{{$attributeGroup->name}}</option>
                    @empty
                        <option value="">Please create attribute group</option>
                    @endforelse
                </select>
                <label for="selectFloatingLabel" style="top:0px" class="placeholder">Attribute Group</label>
                @error('group_id')
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
            <a href="{{route('attribute-groups')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection