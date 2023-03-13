@extends('admin.layouts.app',['page_title' => 'Permissions','action_title' => 'Permissions','page_action' => route('permissions'),'manage'=>'Roles','manage_action' => route('roles')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-permission', $permission->id)}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name') ? old('name') : $permission->name ?? ''}}" type="text" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Permission</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror">
                <textarea name="description"   class="form-control input-border-bottom @error('name')  @enderror" >{{old('description') ? old('description') : $permission->description ?? ''}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('permissions')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection