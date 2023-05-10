<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Classes\EcomController;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
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
use Image;
use File;
use DB;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;
use PHPUnit\TextUI\Help;
use Session;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        ######################################
        $product_ids = $attribute_ids = $order_detail = []; 
        if (Auth::check()) {
            $uuid = Str::uuid();
            $order_detail['id'] = $uuid; 
            $order_detail['user_id'] = $userId = Auth::user()->uuid;
            $order_detail['order_code'] = Helper::randomString(12, 'RXORD-');
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $order_detail['cart_count'] = $data['count'] = $cartCollection->count();
        }
        //dd($cartCollection);
        $discount = $total = $shipping = $payable_amount = 0;
        $qty = [];
        if( isset($cartCollection) && !empty($cartCollection) ){
            foreach($cartCollection as $item_id => $item){
                $ids = explode('_', $item->id);
                if( isset( $ids[1] ) && !empty( $ids[1]) ){
                    $attribute_ids[$item->id] = $ids[1] ?? '';
                    $qty[ $ids[1] ] = $item->quantity;
                }else{
                    $product_ids[$item->id] = $ids[0];
                    $qty[ $ids[0] ] = $item->quantity;
                }                
                //dd($item);
                foreach($item->conditions as $condition){
                    if(isset($condition) && !empty($condition)){
                        
                        if($condition->getType() == 'price'){
                            $disc = $condition->getValue();
                            $discount = $discount + ( ( $item->price * abs((int)rtrim($disc,'%')) ) / 100 ) * $item->quantity;
                        }
                        if($condition->getType() == 'shipping'){
                            $shipping_cost = $condition->getValue();
                            $shipping = $shipping + $condition->getValue() * $item->quantity;
                        }   
                    }        
                }
                $order_detail['discount'] = $discount;
                $order_detail['shipping'] = $shipping;
                $order_detail['total'] = $total = $total + ($item->price * $item->quantity);
                $amount_without_copupon = $total - $discount + $shipping;
            }
        }
        
        $order_detail['payable_amount'] = $data['subTotal'] = $subTotal = $payable_amount = floor(Cart::getSubTotal());

        $data['total'] = Cart::getTotal();
        $data['conditions'] = $conditions = Cart::getConditions();
        
        if( isset($conditions) && !empty($conditions) ){
            foreach( $conditions as $condition ){
                $order_detail['coupon_code'] = $coupon_code = $condition->getName();
                $order_detail['coupon_amount_percent'] = $coupon_amount_percent = abs( rtrim( $condition->getValue(), '%' ) );
                $order_detail['coupon_amount'] = $coupon_amount = round($amount_without_copupon - $payable_amount, 2);
            }
        }  
        //dd($order_detail);

        $product = [];
        $i = 0;
        if( isset($product_ids) && !empty($product_ids) ){
            $products = Product::whereIn('id', $product_ids)->get();
            //dd($products);
            foreach($products as $k => $val){
                $product[$i]['id'] = $id = Str::uuid();
                $product[$i]['product_id'] = $product_id = $val->id;
                $product[$i]['product_attribute_id'] = $product_attribute_id = '';
                $product[$i]['price'] = $price = $val->price;
                $product[$i]['discount'] = $discount = $val->discount;
                $product[$i]['shipping'] = $shipping = $val->shipping_cost;
                $product[$i]['quantity'] = $quantity = $qty[$product_id];
                $product[$i]['comission'] = $comission = $val->comission;
                $product[$i]['featured'] = $featured = $val->featured;
                $product[$i]['total_price'] = $total_price = $price * $quantity;
                $product[$i]['final_price'] = $final_price = ( $price - $discount + $shipping ) * $quantity;
                $i++;
            }
        }
        if( isset($attribute_ids) && !empty($attribute_ids) ){
            $attributes = ProductAttribute::whereIn('id', $attribute_ids)->get();//->toArray();
            if( isset($attributes) && !empty($attributes) ){
                foreach($attributes as $k => $val){
                    $product[$i]['id'] = $id = Str::uuid();
                    $product[$i]['product_id'] = $product_id = $val->product->id;
                    $product[$i]['product_attribute_id'] = $product_attribute_id = $val->id;
                    $product[$i]['price'] = $price = $val->price;
                    $product[$i]['discount'] = $discount = $val->discount;
                    $product[$i]['shipping'] = $shipping = $val->product->shipping_cost;
                    $product[$i]['quantity'] = $quantity = $qty[$product_attribute_id];
                    $product[$i]['comission'] = $comission = $val->product->comission;
                    $product[$i]['featured'] = $featured = $val->product->featured;
                    $product[$i]['total_price'] = $total_price = $price * $quantity;
                    $product[$i]['final_price'] = $final_price = ( $price - $discount + $shipping ) * $quantity;
                    $i++;
                }
            }    
        }
        //dd($product);
        ############################################
        // echo 'pre>';print_r($order_detail);die;
        $order = Order::create($order_detail);
        if($order){
            foreach($product as $prod){
                $prod['order_id'] = $order_id = $uuid;
                $order = OrderDetail::create($prod);
            }
        }
        
        if($order){
            Session::put( 'order_id', $uuid );
            return redirect(route('address'))->with( 'success','Order saved successfully' );
        }else{
            return redirect(route('address'))->with('error','Can\'t save Order');
        }    
    }

    public function listOrders(Request $request){
        $orders = Order::with(['user'])->orderBy('created_at','DESC')->paginate(env('PER_PAGE'))->withQueryString();
        // dd($orders);
        return view('admin.orders',array('orders'=>$orders));
    }

    public function orderDetail(Request $request, $id){
        $order = Order::with(['user','payment','orderDetails'])->where('id',$id)->get();
        $order = $order[0] ?? null;
        $order['products'] = Order::products($order);
        // dd($order);
        if(empty($order)){
            return redirect(back())->with('error','Product detail not found!');
        }
        // dd($order);
        return view('admin.order-detail',array('order'=>$order));
    }
}
