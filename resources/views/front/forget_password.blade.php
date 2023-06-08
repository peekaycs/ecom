@extends('front.layouts.app')
@section('content')
<section class="login-section">
    <div class="container">
        <div class="row"> 
            <div class="login">  
                <form class="login-content signup-content animate" action="{{route('reset_password')}}" method="post">
                    <input type="hidden" name="user_type" value="1">
                    <div class="signup-heading">Forget Password</div>
                    @csrf
                    <input type="hidden" name="last_url" value="{{url()->previous()}}">
                    <div class="login-container">
                        <label for="email id"><b>Email Id</b></label>
                        <input type="email" placeholder="Email Address" name="email" maxlength="256" minlength="4" required>
                        @error('email')
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