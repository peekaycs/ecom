@extends('admin.layouts.app',['page_title' => 'My Profile'])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('admin-profile-store',$user->uuid)}}" enctype="multipart/form-data">
        
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('first_name') has-error @enderror" >
                <input id="" name="first_name" value="{{old('first_name') ? old('first_name') : $user->first_name}}" type="text" class="form-control input-border-bottom " required>
                <label for="inputFloatingLabel" class="placeholder">First Name</label>
                @error('first_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('last_name') has-error @enderror">
                <input id="" name="last_name" value="{{old('last_name') ? old('last_name') : $user->last_name}}" type="text" class="form-control input-border-bottom   " required>
                <label for="inputFloatingLabel" class="placeholder">Last Name</label>
                @error('last_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('mobile') has-error @enderror">
            <input id="" name="mobile" value="{{old('mobile') ? old('mobile') : $user->mobile}}" type="number" class="form-control input-border-bottom " step="1" required>
                <label for="inputFloatingLabel" class="placeholder">Mobile</label>
                @error('mobile')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
           
            <div class="form-group @error('image') has-error @enderror">
                    <label for="exampleFormControlFile" class="placeholder">Profile Image</label>
                        <input type="file" class="form-control input-border-bottom" name="image" id="image" required>
                        @error('image')
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