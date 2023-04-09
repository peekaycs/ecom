@extends('admin.layouts.app',['page_title' => 'Admin User'])

@section('content')

<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('update-admin-user',$user->id)}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('first_name') has-error @enderror">
                <input id="" name="first_name" value="{{old('first_name') ?? ($user->first_name)}}" type="text" class="form-control input-border-bottom @error('first_name')  @enderror" required>
                <label for="inputFloatingLabel" class="placeholder">First Name</label>
                @error('first_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('middle_name') has-error @enderror">
                <input id="" name="middle_name" value="{{old('middle_name') ?? $user->middle_name }}" type="text" class="form-control input-border-bottom @error('middle_name')  @enderror" >
                <label for="inputFloatingLabel" class="placeholder">Middle Name</label>
                @error('middle_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('last_name') has-error @enderror">
                <input id="" name="last_name" value="{{old('last_name') ?? $user->last_name}}" type="text" class="form-control input-border-bottom @error('last_name')  @enderror" >
                <label for="inputFloatingLabel" class="placeholder">Last Name</label>
                @error('last_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('email') has-error @enderror">
                <input id="" name="email" value="{{old('email') ?? $user->email}}" type="email" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Email</label>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- <div class="form-group form-floating-label @error('password') has-error @enderror">
                <input id="" name="password" value="{{old('password')}}" type="password" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Password</label>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div> -->
            <!-- <div class="form-group form-floating-label @error('password_confirmation') has-error @enderror">
                <input id="" name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Confirm Password</label>
                @error('password_confirmation')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div> -->
            <div class="form-group form-floating-label @error('mobile') has-error @enderror">
                <input id="" name="mobile" value="{{old('mobile') ?? $user->mobile}}" type="number" pattern="[0-9]" step=1 class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Mobile</label>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('age') has-error @enderror">
                <input id="" name="age" value="{{old('age') ?? $user->userProfile->age}}" type="number"  class="form-control input-border-bottom" step="1" min="1" >
                    <label for="inputFloatingLabel" class="placeholder">Age</label>
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
            </div>
            <div class="form-group form-floating-label @error('gender') has-error @enderror">
                <select id="" name="gender"  class="form-control input-border-bottom" >
                    <option value=""></option>
                    <option value="male" {{old('gender') ? "selected" : ($user->userProfile->gender == 'male' ? 'selected' :'')}}>Male</option>
                    <option value="female" {{old('gender') ? "selected" : ($user->userProfile->gender == 'female' ? 'selected' :'') }}>Female</option>
                    <option value="other" {{old('gender') ? "selected" : ($user->userProfile->gender == 'other' ? 'selected' :'')}}>Other</option>
                </select>
                    <label for="inputFloatingLabel" class="placeholder">Gender</label>
                    @error('gender')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
            </div>
            <div class="form-group form-floating-label @error('is_active') has-error @enderror">
                <select class="form-control input-border-bottom" name="is_active" id="is_active" required>
                    <option value="1" {{old('is_active') == '1' ? 'selected' : ($user->getOriginal('is_active') == 1 ? 'selected' : '')}}>Enable</option>
                    <option value="0" {{old('is_active') == '0' ? 'selected' : ($user->getOriginal('is_active') == 0 ? 'selected' : '')}}>Disable</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Status</label>
                @error('is_active')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Select Roles</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($roles as $role)
                        <label class="selectgroup-item pl-5">
                            <input type="checkbox" name="roles[]" value="{{$role->name}}" class="selectgroup-input" {{ $user->roles->contains('name',$role->name) ? 'checked' : ''}} >
                            <span class="selectgroup-button">{{$role->name}}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <!-- <div class="form-group"><hr></div>
            <div class="form-group">
                <label class="form-label">Select Permissions</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($permissions as $permission)
                        <label class="selectgroup-item pl-5">
                            <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="selectgroup-input" >
                            <span class="selectgroup-button">{{$permission->name}}</span>
                        </label>
                    @endforeach
                </div>
            </div> -->
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('admin-users')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection