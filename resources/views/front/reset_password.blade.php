@extends('front.layouts.app')
@section('content')
<section class="login-section">
    <div class="container">
        <div class="row"> 
            <div class="login">  
                <form class="login-content signup-content animate" action="{{route('save_password')}}" method="post">
                    <input type="hidden" name="user_type" value="1">
                    <div class="signup-heading">Reset Password</div>
                    @csrf
                    <input type="hidden" name="last_url" value="{{url()->previous()}}">
                    <input type="hidden" name="e" value="{{ $_GET['e'] }}">
                    <div class="login-container">
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