@extends('admin.layouts.app',['page_title' => 'Attributes','action_title' => 'Attributes','page_action' => route('attributes'),'manage'=>'Attribute Groups','manage_action' => route('attribute-groups')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-attribute',$attribute->id)}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name') ? old('name') : ($attribute->name ?? '')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Attribute</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('group_id') has-error @enderror">
                <select class="form-control input-border-bottom" name="group_id" id="group_id" required>
                    <option value="">Select</option>
                    @forelse($attributeGroups as $attributeGroup)
                        <option value="{{$attributeGroup->id}}" {{old('group_id') == $attributeGroup->id  ? "selected" :($attribute->group_id == $attributeGroup->id ? "selected" : "")}}>{{$attributeGroup->name}}</option>
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
                    <option value="1" {{ (old('status') && old('status') == '1') ? "selected" : ($attribute->status == '1' ? "selected" : "")}}>Enable</option>
                    <option value="0" {{ (old('status') && old('status') == '0') ? "selected" : ($attribute->status == '0' ? "selected" : "")}}>Disable</option>
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