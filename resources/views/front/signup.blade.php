@extends('front.layouts.app')
@section('content')
<section class="login-section">
    <div class="container">
        <div class="row"> 
            <div class="login">  
                <form class="login-content signup-content animate" action="{{route('register')}}" method="post">
                    <input type="hidden" name="user_type" value="1">
                    <div class="signup-heading">Sign-Up</div>
                    @csrf
                    <input type="hidden" name="last_url" value="{{url()->previous()}}">
                    <div class="login-container">
                        <label for="Name"><b>First Name</b></label>
                        <input type="text" name="first_name" placeholder="First Name"  value="{{old('first_name')}}" required>
                        @error('first_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="Name"><b>Last Name</b></label>
                        <input type="text" name="last_name" placeholder="Last Name" value="{{old('last_name')}}" required>
                        @error('last_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="mobile-number"><b>Mobile Number</b></label>
                        <input type="number" placeholder="Mobile Number" name="mobile" value="{{old('mobile')}}" maxlength="10" minlength="10" required>
                        @error('mobile')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="email id"><b>Email Id</b></label>
                        <input type="email" placeholder="Email Address" name="email" value="{{old('email')}}" maxlength="256" minlength="4" required>
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="psw"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Enter Confirm Password" name="password_confirmation" required>
                        @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="col-12 mt-2 text-center">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            <!-- <a class="submit" href="i">Continue</a> -->
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection