@extends('front.layouts.app')
@section('content')
<section class="mt-4">
	<div class="container">
		<div class="row">				
			<div class="col-md-9 col-sm-9 col-12">
				<div class="checkout-section">
					<h6>Select Payment Method</h6>
					<hr>
					<div class="col-md-12 col-sm-12 col-12">
						<div class="tab-section">
							<ul class="nav nav-tabs">
								<li>
									<a data-bs-toggle="tab" href="#DC-Card" class="active">Debit Card/Credit Card</a>
								</li>
								<li>
									<a data-bs-toggle="tab" href="#UPI">UPI</a>
								</li>
								<li>
									<a data-bs-toggle="tab" href="#Paytm-and-Wallet">Paytm/Wallet</a>
								</li>
								
								<li>
									<a data-bs-toggle="tab" href="#COD">Cash On Delivery (COD)</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="DC-Card" class="tab-pane fade active show">
									<form action="">
										<div class="row">		
											<div class="col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label>Email Id :</label>
													<div class="col-sm-12 col-12">
														<input type="text" class="form-control rounded-0" placeholder="Email Id">
													</div>
												</div>
												<div class="form-group">
													<label>Name :</label>
													<div class="col-sm-12 col-12">
														<input type="text" class="form-control rounded-0" placeholder="Card Holder Name">
													</div>
												</div>
												<div class="form-group">
													<label>Card Number :
														<img class="card-icon" src="images/visa-card.png">
													</label>
													<div class="col-sm-12 col-12">
														<div class="card-group">
															<span class="s1"></span>													
															<div class="card-field">
																<input type="text" class="text-cardno" placeholder="xxxx" maxlength="4">                                        
																<input type="text" class="text-cardno" placeholder="xxxx" maxlength="4">
																<input type="text" class="text-cardno" placeholder="xxxx" maxlength="4">
																<input type="text" class="text-cardno" placeholder="xxxx" maxlength="4">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8 col-sm-8 col-12">
												<div class="form-group">
													<label>Expiry Date:</label>
													<div class="col-md-12 col-sm-12 col-12">
														<div class="card-group">
															<span></span>
															<div class="card-field">
																<input type="text" class="text-exp" placeholder="MM" maxlength="2">
																<input type="text" class="text-exp" placeholder="YYYY" maxlength="4">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-12">
												<div class="form-group">
													<label>CVV No (<span>*</span>) :</label>
													<div class="col-md-12 col-sm-12 col-12">
														<input type="text" class="form-control rounded-0" placeholder="xxx" maxlength="3">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-sm-12 col-12">
												<div class="col-sm-12 col-12 text-center"><hr>
													<a href="#" class="btn btn-primary">Pay Now</a>
													<!-- <button type="button" class="btn btn-primary">Pay Now</button> -->
												</div>
											</div>
										</div>
									</form>
								</div>
								<div id="UPI" class="tab-pane fade">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											<label>UPI Id :</label>
											<div class="col-md-12 col-sm-12 col-12">
												<div class="input-group">
													<input type="text" class="form-control rounded-0 border-end-0" placeholder="Enter UPI Id">
													<button type="button" class="bg-transparent border-start-0 input-group-text text-danger">Verify</button>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-12 text-center mt-3">
												<a href="#" class="btn btn-primary">Pay Now</a>
												<!-- <button type="button" class="btn btn-primary">Pay Now</button> -->
											</div>
										</div>
									</div>									
								</div>
								<div id="Paytm-and-Wallet" class="tab-pane fade">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12">
											<label>UPI Id :</label>
											<div class="col-md-12 col-sm-12 col-12">
												<div class="input-group">
													<input type="text" class="form-control rounded-0 border-end-0" placeholder="Enter UPI Id">
													<button type="button" class="bg-transparent border-start-0 input-group-text text-danger">Verify</button>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-12 text-center mt-3">
												<a href="#" class="btn btn-primary">Pay Now</a>
												<!-- <button type="button" class="btn btn-primary">Pay Now</button> -->
											</div>
										</div>
									</div>
								</div>
								<div id="NetBanking" class="tab-pane fade">
									<div class="col-md-12 col-sm-12 col-12">
										<div class="col-md-12 col-sm-12 col-12">
											<label class="col-sm-12 col-12 control-label">Bank Name:</label>
											<div class="col-sm-12 col-12">
												<select class="textstyl">
													<option>Selectl Bank</option>
													<option>SBI</option>
													<option>HDFC</option>
													<option>ICICI</option>
													<option>PNB</option>
													<option>BOB</option>
													<option>Yes Bank</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12 col-12 text-center margin-top10">
											<a href="#" class="btn btn-primary">Pay Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>					
					</div>
				</div>
				<div class="checkout-section2">
					<h6>Select Payment Method</h6>
					<hr>
					<div class="col-md-12 col-sm-12 col-12">
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="DCU" name="payment-method" checked>
										<label class="form-check-label" for="DCU">
											<strong>Debit Card / Credit Card / UPI</strong>
										</label>
										<p>Visa, MasterCard, Maestro Card, American Express</p>
										<figure>
											<img src="images/visa.png" alt="">
											<img src="images/mastercard.png" alt="">
											<img src="images/american-express.png" alt="">
										</figure>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. 400
									</a>
								</div>
							</div>
						</div>
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="Netbanking" name="payment-method">
										<label class="form-check-label" for="Netbanking">
											<strong>Netbanking / Wallets</strong>
										</label>
										<p>PhonePe, Freecharge, Payzapp, Ola Money, Jio Money, Airtel Money</p>
										<figure>
											<img src="images/banklogo.png" alt="">											
										</figure>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. 400
									</a>
								</div>
							</div>
						</div>
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="Paytm" name="payment-method">
										<label class="form-check-label" for="Paytm"><strong>Paytm Wallet</strong></label>
										<p>Pay with Paytm</p>
										<figure>
											<img src="images/paytm-wallet.png" alt="">
										</figure>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. 400
									</a>
								</div>
							</div>
						</div>
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="COD" name="payment-method">
										<label class="form-check-label" for="COD"><strong>Cash On Delivery (COD)</strong></label>
										<p>Now avail Cash on Delivery, and pay when you get delivery</p>
										<p><strong class="text-danger">COD charge 50 extra</strong></p>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<div class="cod">
										<span>Total Price (<i class="fa fa-rupee-sign fa-xs"></i>) 400</span> + <span>50</span>
									</div>
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. 450
									</a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-12 m-padding-lr">
                <div class="cart-section">
                    <h5 class="alert alert-info">Order Summary (3 Items)</h5>
                    <div class="check-out">
                        <p>
                            MRP Total
                            <span>Rs 360</span>
                        </p>									
                        <p>
                            Price Discount
                            <span>- ₹ 50</span>
                        </p>
                        <p>
                            Shipping Charges
                            <span>40</span>
                        </p>
                        <hr>
                        <p>
                            <strong>To be paid</strong>
                            <span><strong>Rs 400</strong></span>
                        </p>
                        <hr>
                    </div>                    
                    <div class="alert alert-success">
                        <span>Total Savings: <strong>Rs 50</strong></span>
                        <!-- <button type="button" class="btn btn-sm btn-success float-end">CHECKOUT</button> -->
                        <!-- <a href="address.php" type="button" class="btn btn-sm btn-success float-end">Proceed</a> -->
                    </div>
                </div>                
            </div>
		</div>
	</div>
</div>
<!---end header section-->
@endsection