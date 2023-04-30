<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\EcomController;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductAttributeImage;
use App\Models\Attribute;
use App\Models\ProductDetail;
use App\Rules\AlphaNumSpace;
use App\Helpers\Helper;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Models\Payment;
use URL;
use Image;
use File;
use DB;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;

use Session;
//use Mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class CheckoutController extends EcomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $uuid)
    {
        //
        //cart detail
        $product_ids = $attribute_ids = [];        
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            $data['count'] = $cartCollection->count();
        }
        if( isset($cartCollection) && !empty($cartCollection) ){
            foreach($cartCollection as $item_id => $item){
                $ids = explode('_', $item->id);
                $product_ids[$item->id] = $ids[0];
                $attribute_ids[$item->id] = $ids[1] ?? '';
            }
        }
         
        if( isset($product_ids) && !empty($product_ids) ){
            $products = Product::whereIn('id', $product_ids)->get()->toArray();
            foreach($products as $k => $val){
                $product[$val['id']] = $val;
            }
            $data['product'] = $product;
        }
        if( isset($attribute_ids) && !empty($attribute_ids) ){
            $attributes = ProductAttribute::whereIn('attribute_id', $attribute_ids)->get()->toArray();
            if( isset($attributes) && !empty($attributes) ){
                foreach($attributes as $k => $val){
                    $attribute[$val['product_id']] = $val;
                }
                $data['attribute'] = $attribute;
            }    
        }
        $data['subTotal'] = Cart::getSubTotal() ? floor(Cart::getSubTotal()) : 0;
        $data['total'] = Cart::getTotal();        
        $data['conditions'] = $conditions = Cart::getConditions();
        //end
        $address = Address::where('uuid', $uuid)->get();
        if(isset($address) && !empty($address)){
            foreach($address as $add){
                $address_comp = ucFirst($add->name)  .' \n '.$add->contact .' \n '. $add->address . ' , ' . $add->landmark .' , '. $add->city .' , \n ' . $add->state . ' - ' . $add->zip;
            }
            $data['order_id'] = $order_id = Session::get('order_id');
            $address = DB::update('update orders set shipping_address = ? where id = ?',[$address_comp, $order_id ]);
            //$address = Order::updateOrCreate( [ 'id'=>$order_id ], [ 'user_id' => $userId, 'shipping_address' => $address_comp ] );
        }
        
       
        return $this->createView('front.checkout',$data);
    }



    public function createOrderRazorpay($inputData){

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

          
            //
            $orderData = [
                'receipt'         => Session::get('order_id'),
                'amount'          => Auth::user()->email == 'prmodcs123@gmail.com' ? 1*100 : $inputData['subTotal'] * 100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 0 // auto capture
            ];
            Session::put('payment_details', $orderData);
            $razorpayOrder = $api->order->create($orderData);

            $razorpayOrderId = $razorpayOrder['id'];

            Session::put('razorpay_order_id', $razorpayOrderId);

            $displayAmount = $amount = $orderData['amount'];


            $checkout = 'automatic';

           

            $data = [
                "key"               => env('RAZORPAY_KEY'),
                "amount"            => $amount,
                "name"              => Auth::user()->first_name. ' ' . Auth::user()->last_name,
                "description"       => "Rx4uAll",
                "image"             => URL::asset('assets/front/images/logo.png'),
                "prefill"           => [
                "name"              => Auth::user()->first_name. ' ' . Auth::user()->last_name,
                "email"             => Auth::user()->email,
                "contact"           => Auth::user()->mobile,
                ],
                "notes"             => [
                "address"           => "Address",
                "merchant_order_id" => Session::get('order_id'),
                ],
                
                "order_id"          => $razorpayOrderId,
            ];

            // $json = json_encode($data);
            return $data;
    }

    public function pay(Request $request)
    {
        //dd($request);
        $userId = Auth::user()->uuid;
        $data['user'] = $user = User::find($userId);
        $data['order'] = $order = Order::find($request->order_id);
        $receiving_amount = $order->payable_amount;
        $flag = false;

        if( isset( $request->mode ) && !empty( $request->mode ) && $request->mode == 'CHEQUE' ){
            $request->validate([
                'cheque_dd_number' => 'required|string',
                'order_id' => 'required|string',
                'mode' => 'required|string',
                'bank_name' => 'string',
                'amount' => 'required|integer',
                'fill_amount' => 'required|integer',
            ]);
            
            $uuid = Str::uuid();
            $transaction_id = Helper::randomString(12,'RXTNCQ-');
            $payments = 0;
            if( ( $request->amount <= $request->fill_amount ) && ( $receiving_amount <= $request->amount ) ){
                $flag = true;
                $payments = Payment::create([
                    'id' => $uuid,
                    'transaction_id' => $transaction_id,
                    'order_id' => $request->order_id,
                    'mode' => $request->mode,
                    'cheque_dd_number' => $request->cheque_dd_number,
                    'bank_name' => $request->bank_name,
                    'amount' => $request->amount,
                    'payment_status' => 'SUCCESS'
                ]);
            } 
            
            $to_name = 'arvind';
            $to_email = 'arvindpandeymail@gmail.com';
            $dat = array('name' => $to_name, 'body' => 'Order Successfull');

            Mail::send('emails.order_mail', $dat, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('order successfull');
                    $message->from('help@icarehomeo.com', 'Order Mail');
                }
            );
        } 
        
        if( isset( $request->mode ) && !empty( $request->mode ) && $request->mode == 'COD' ){
            $request->validate([
                'order_id' => 'required|string',
                'mode' => 'required|string',
                'amount' => 'required|string',
            ]);
            
            $uuid = Str::uuid();
            $transaction_id = Helper::randomString(12,'RXTNCD-');
            $payments = 0;
            if( $receiving_amount <= $request->amount ){
                $flag = true;
              
                $payments = Payment::create([
                    'id' => $uuid,
                    'transaction_id' => $transaction_id,
                    'order_id' => $request->order_id,
                    'mode' => $request->mode,
                    'amount' => $request->amount,
                    'payment_status' => 'SUCCESS'
                ]);
            }    
        } 

        // online payment

        if( isset( $request->mode ) && !empty( $request->mode ) && $request->mode == 'ONLINE' ){
            $request->validate([
                'order_id' => 'required|string',
                'mode' => 'required|string',
                'amount' => 'required|string',
            ]);
            
            $uuid = Str::uuid();
            $transaction_id = Helper::randomString(12,'RXTNON-');
            $payments = 0;
            if( $receiving_amount <= $request->amount ){
                $flag = true;
               
                
                $payments = Payment::create([
                    'id' => $uuid,
                    'transaction_id' => $transaction_id,
                    'order_id' => $request->order_id,
                    'mode' => $request->mode,
                    'amount' => $request->amount,
                    'payment_status' => 'SUCCESS'
                ]);
            }    
        } 
         
        if($payments){
            Cart::session($userId)->clear();
            Cart::clear();
            Session::put( 'order_id', $request->order_id );
            Session::flash('msg', 'Congratulations! Your Order Placed Successfully. Thank You'); 
            return redirect(route('thankyou'))->with('success','Congratulations! Your Order Placed Successfully. Thank You');
        }elseif($flag == false){
            Session::flash('msg', 'Amount is insufficiant!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('checkout'))->with('error','Amount is insufficiant!');
        }else{
            Session::flash('msg', 'Can\'t proceed with this payment method'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect(route('checkout'))->with('error','Can\'t proceed with this payment method');
        }    
    }


    public function getOrderDetails(){
        //cart detail
        $product_ids = $attribute_ids = [];        
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            $data['count'] = $cartCollection->count();
        }
        if( isset($cartCollection) && !empty($cartCollection) ){
            foreach($cartCollection as $item_id => $item){
                $ids = explode('_', $item->id);
                $product_ids[$item->id] = $ids[0];
                $attribute_ids[$item->id] = $ids[1] ?? '';
            }
        }
         
        if( isset($product_ids) && !empty($product_ids) ){
            $products = Product::whereIn('id', $product_ids)->get()->toArray();
            foreach($products as $k => $val){
                $product[$val['id']] = $val;
            }
            $data['product'] = $product;
        }
        if( isset($attribute_ids) && !empty($attribute_ids) ){
            $attributes = ProductAttribute::whereIn('attribute_id', $attribute_ids)->get()->toArray();
            if( isset($attributes) && !empty($attributes) ){
                foreach($attributes as $k => $val){
                    $attribute[$val['product_id']] = $val;
                }
                $data['attribute'] = $attribute;
            }    
        }
        $data['subTotal'] = Cart::getSubTotal() ? floor(Cart::getSubTotal()) : 0;
        $data['total'] = Cart::getTotal(); 
        return $data;       
    }

    public function razorPayAction(Request $request){
        $data = $this->getOrderDetails();
         // razprapy order generate
         $json = $this->createOrderRazorpay($data);
       
        return view('front.razorpay',array('json' =>json_encode($json)));
         
    }


    public function veryfyRazorpayAction(Request $request){
        // get payment from razor pay
        $input = $request->all();
                  
        if(empty($input['razorpay_payment_id'])){
            return redirect(route('thankyou'))->with('error','Your payment has been cancelled');
        }
        $paymentDetails = Session::get('paymentDetails');
        $uuid = Str::uuid();
        $transaction_id = Helper::randomString(12, 'RXTXN-');
        $response = $this->veryfyPayment($request); // verify payment
        if($response['status']){ // payment successful
            $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            if(count($input) && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                    $paymentArray = [
                        'id' => $uuid,
                        'transaction_id' => $transaction_id,
                        'order_id' => Session::get('order_id'),
                        'mode' => 'ONLINE',
                        'amount' => $response['amount']/100,
                        'payment_status' => 'SUCCESS'
                    ];
                    $payments = Payment::create($paymentArray);
                    // Session::put('paymentResponse', $paymentArray);
                    return redirect(route('thankyou'))->with('success','Thank you for the payment, we have received your payment successfully. Your transaction id is: ' . $transaction_id);
                } catch(Exception $e) {
                    return $e->getMessage();
                    Session::put('paymentError',$e->getMessage());
                    return redirect()->back();
                }
            }
        }else{ // payment failed
            $payments = Payment::create([
                'id' => $uuid,
                'transaction_id' => $transaction_id,
                'order_id' => Session::get('order_id'),
                'mode' => 'ONLINE',
                'amount' => $paymentDetails['amount'],
                'payment_status' => 'FAILED'
            ]);
            return redirect(route('thankyou'))->with('error','Your payment has been filed, Please try again to confirm your order');
        }
    }


    public function veryfyPayment($request){
        $response= ['status' => true];
        try{
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => Session::get('razorpay_order_id'),
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        );
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $api->utility->verifyPaymentSignature($attributes);
        }
        catch(SignatureVerificationError $e){
            $response['status'] = false;
            $response['error'] = 'Razorpay Error : ' . $e->getMessage();
        }
        
        return $response;
    }

    public function thankyou(Request $request)
    {
        //dd($request);
        $userId = Auth::user()->uuid;
        $data['user'] = User::find($userId);
        $order_id = Session::get('order_id');
        $data['order'] = Order::find($order_id);
        
        return $this->createView('front.thankyou',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
