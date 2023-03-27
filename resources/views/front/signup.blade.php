@extends('front.layouts.app')
@section('content')
<section class="login-section">
    <div class="container">
        <div class="row"> 
            <div class="login">  
                <form class="login-content signup-content animate" action="/action_page.php" method="post">
                    <div class="signup-heading">Sign-Up</div>
                    <div class="login-container">
                        <label for="Name"><b>Name</b></label>
                        <input type="text" placeholder="Enter Your Name" name="Name" required>

                        <label for="mobile-number"><b>Mobile Number</b></label>
                        <input type="text" placeholder="Enter Mobile Number" name="mobile-number" required>
                        
                        <label for="email id"><b>Email Id</b></label>
                        <input type="text" placeholder="Enter email Id" name="email id" required>
                        
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>
                        
                        <label for="psw"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Enter Confirm Password" name="psw" required>
                        <div class="col-12 mt-2 text-center">
                            <a class="submit" href="index.php">Continue</a>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection