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
        <div class="row" >
            <div class="col-md-6 col-lg-6">
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
                <div class="form-group form-floating-label @error('age') has-error @enderror">
                <input id="" name="age" value="{{old('age') ? old('age') : ($user->userProfile->age ?? '')}}" type="number" class="form-control input-border-bottom " step="1" min="1" required>
                    <label for="inputFloatingLabel" class="placeholder">Age</label>
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group form-floating-label @error('age') has-error @enderror">
                <select id="" name="gender"  class="form-control input-border-bottom" >
                    <option value=""></option>
                    <option value="male" {{old('gender') ? "selected" : ( $user->userProfile->gender == 'male' ? "selected" : "")}}>Male</option>
                    <option value="female" {{old('gender') ? "selected" : ( $user->userProfile->gender == 'female' ? "selected" : "")}}>Female</option>
                    <option value="other" {{old('gender') ? "selected" : ( $user->userProfile->gender == 'other' ? "selected" : "")}}>Other</option>
                </select>
                    <label for="inputFloatingLabel" class="placeholder">Gender</label>
                    @error('gender')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
               
                <div class="form-group form-floating-label @error('address') has-error @enderror">
                <input id="" name="address" value="{{old('address') ? old('address') : $user->userAddress[0]->address}}" type="text" class="form-control input-border-bottom "  >
                    <label for="inputFloatingLabel" class="placeholder">Address</label>
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group form-floating-label @error('city') has-error @enderror">
                <input id="" name="city" value="{{old('city') ? old('city') : $user->userAddress[0]->city}}" type="text" class="form-control input-border-bottom "  >
                    <label for="inputFloatingLabel" class="placeholder">City</label>
                    @error('city')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group form-floating-label @error('state') has-error @enderror">
                <input id="" name="state" value="{{old('state') ? old('state') : $user->userAddress[0]->state}}" type="text" class="form-control input-border-bottom "  >
                    <label for="inputFloatingLabel" class="placeholder">State</label>
                    @error('state')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group d-flex @error('image') has-error @enderror" >
                <div class="col-md-3">
                    <label for="exampleFormControlFile" class="placeholder">Profile Image</label>
                        <input type="file" class="form-control input-border-bottom" name="image" id="image" >
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                </div>
                <div class="col-md-3">
                    <label class="imagecheck mb-4">
                        <figure class="imagecheck-figure">
                            <img src="{{url($user->userProfile->image ?? '')}}" alt="title" class="imagecheck-image">
                        </figure>
                    </label>
                </div>
            </div>
        </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{route('categories')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection