@extends('admin.layouts.app',['page_title' => 'Roles','action_title' => 'Roles','page_action' => route('roles'),'manage'=>'Brands','manage_action' => route('roles')])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-role')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom @error('name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">Role</label>
                @error('name')
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
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('roles')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection