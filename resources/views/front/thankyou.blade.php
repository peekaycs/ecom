@extends('front.layouts.app')

@section('content')	
<section class="mt-4">
	<div class="container">			
        <div class="row">            
            <div class="col-md-12 col-sm-12 col-12">
                <div class="thankyou">
                    <figure><img src="{{URL::asset('assets/front/images/thankyou.png')}}" alt="thank you"></figure>
                    <h4>THANK YOU</h4>
                    <p>Your order has been successfully placed. Our team will contact you soon.</p>
                    <div class="col-12 mt-md-4 mt-3"><a href="#" class="">Back Home</a></div>                    
                </div>
            </div>
        </div>
	</div>
</section>
@endsection