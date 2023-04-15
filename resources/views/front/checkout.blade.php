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
				<?php $total_discount = $total_price = $shipping = 0;?>
				@if( isset($cart_list) && !empty($cart_list) )
					@foreach($cart_list as $item_id => $item)
						@foreach($item->conditions as $condition)
							@if(isset($condition) && !empty($condition))
								@if($condition->getType() == 'shipping')
									<?php $shipping = $shipping + $condition->getValue(); ?>
								@endif    
							@endif        
						@endforeach
						<?php
						$total_discount = $total_discount + ($item->price - $item->getPriceWithConditions()) * $item->quantity;
						$total_price = $total_price + ($item->price * $item->quantity);
						?>
					@endforeach
				@endif 
				<?php 
				$ids = explode('_', $item_id);
				$product_id = $ids[0];
				$attribute_id = $ids[1] ?? '';?>
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
											<strong>Check</strong>
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
									<a data-bs-toggle="tab" href="#check" class="btn btn-info d-block">
										Pay Rs. {{ $subTotal ?? '' }}
									</a>
								</div>
							</div>
							
							<div class="row tab-pane " id="check">
								<div class="col-md-6 col-sm-12 col-12">
									<form action="{{ route('pay') }}" method="POST">
										@csrf
										<input type="hidden" name="mode" value="DD">
										<input type="hidden" name="order_id" value="{{ $order_id ?? '12' }}">
										<div class="col-md-12 col-sm-12 col-12">
											<label>Cheque Number :</label>
											<input type="text" name="cheque_number" class="form-control rounded-0 border-end-1 @error('cheque_number') has-error @enderror" placeholder="Enter cheque number">
											@error('cheque_number')
											<p class="text-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<label>Bank Name :</label>
											<input type="text" name="bank_name" class="form-control rounded-0 border-end-1 @error('bank_name') has-error @enderror" placeholder="Enter Bank name">
											@error('bank_name')
											<p class="text-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<label>Account Number :</label>
											<input type="text" name="account_number" class="form-control rounded-0 border-end-1 @error('account_number') has-error @enderror" placeholder="Enter account number">
											@error('account_number')
											<p class="text-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<label>IFSC Code :</label>
											<input type="text" name="ifsc" class="form-control rounded-0 border-end-1 @error('ifsc') has-error @enderror" placeholder="Enter ifsc code">
											@error('ifsc')
											<p class="text-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<label>Amount</label>
											<input type="text" name="amount" class="form-control rounded-0 border-end-1 @error('amount') has-error @enderror" placeholder="Enter Check Amount">
											@error('amount')
											<p class="text-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="col-md-12 col-sm-12 col-12 text-center mt-3">
											<!--<a href="#" class="btn btn-primary">Pay Now</a>-->
											<button type="submit" name="submit" class="btn btn-primary">Pay Now</button>
										</div>
									</form>	
								</div>
							</div>
						</div>
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="Netbanking" name="payment-method">
										<label class="form-check-label" for="Netbanking">
											<strong>Demand Draft (DD)</strong>
										</label>
										<p>PhonePe, Freecharge, Payzapp, Ola Money, Jio Money, Airtel Money</p>
										<figure>
											<img src="images/banklogo.png" alt="">											
										</figure>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. {{ $subTotal ?? '' }}
									</a>
								</div>
							</div>
						</div>
						<div class="payment-method">
							<div class="row">
								<div class="col-md-9 col-sm-9 col-8">
									<div class="form-check">
										<input type="radio" class="form-check-input" id="Paytm" name="payment-method">
										<label class="form-check-label" for="Paytm"><strong>Online</strong></label>
										<p>Pay with Paytm</p>
										<figure>
											<img src="images/paytm-wallet.png" alt="">
										</figure>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. {{ $subTotal ?? '' }}
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
										<p><strong class="text-danger">COD charge 20 extra</strong></p>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-4 text-end">
									<div class="cod">
										<span>Total Price (<i class="fa fa-rupee-sign fa-xs"></i>) {{ $subTotal ?? '' }}</span> + <span>20</span>
									</div>
									<a href="javascript:void(0)" class="btn btn-info d-block">
										Pay Rs. {{ $subTotal ? $subTotal+20 : '' }}
									</a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-12 m-padding-lr">
                <div class="cart-section">
                    <h5 class="alert alert-info">Order Summary ( {{$count ?? '0'}} Items)</h5>
                    <div class="check-out">
                        <p>
                            MRP Total
                            <span>Rs {{ $total_price ?? '' }}</span>
                        </p>									
                        <p>
							{{ isset($total_discount) ? 'Price Discount' : ''}}
                            <span>{{ isset($total_discount) ? '-₹'. $total_discount : '0'}}</span>
                        </p>
                        <p>
							{{ 'Shipping Charges' }} 
                            <span>{{ '+₹'.$shipping ?? '+₹0' }}</span>
                        </p>
                        <hr>
						@if( isset($conditions) && !empty($conditions) )
                            @foreach($conditions as $key => $condition)
                            <p>
                                <strong>{{ $condition->getType() != null ? ucwords($condition->getType()) . ' Discount' : '' }} 
                                    <small style="color:red"><a href="javascript:void(0)" onclick="removeCoupon(this, '{{ $condition->getName() ?? ''}}')">Remove</a></small>
                                </strong>
                                <span><strong>Rs {{ $condition->getValue() ?? ''}}</strong></span>
                            </p>
                            @endforeach
                        @endif
                        <p>
							<strong>To be paid</strong>
                            <span><strong>Rs {{ $subTotal ?? '' }}</strong></span>
                        </p>
                        <hr>
                    </div>                    
                    <div class="alert alert-success">
						<span>Total Savings: <strong>{{ isset($total_discount) ? '₹'. $total_discount : '0'}}</strong></span>
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