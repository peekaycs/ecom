<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\CartCondition;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Classes\EcomController;
use App\Models\Brand;

use App\Helpers\Helper;
use App\Models\Coupon;

use Image;
use File;
use DB;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ProductAttribute;
class CartStorageNewController extends EcomController
{
    public function cart_list()
    {
        $product_ids = $attribute_ids = [];
        $data['popular_health'] = Product::orderby('order','ASC')->get();
        
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
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
            $attributes = ProductAttribute::whereIn('id', $attribute_ids)->get();//->toArray();
            if( isset($attributes) && !empty($attributes) ){
                $attribute = [];
                foreach($attributes as $k => $val){
                    $attribute[$val['product_id']] = $val;
                }
                $data['attribute'] = $attribute;
            }    
        }
        
        // $data['count'] = $cartCollection->count();   //$data['count'] = getTotalQuantity();
        $data['subTotal'] = round( Cart::getSubTotal(), 2 );
        $data['total'] = Cart::getTotal();
        //dd($cartCollection);
        
        $data['conditions'] = $conditions = Cart::getConditions();
        //dd($conditions);
        /*foreach($conditions as $condition){
            $data['target'] = $condition->getTarget(); // the target of which the condition was applied
            $data['name'] = $condition->getName(); // the name of the condition
            $data['type'] = $condition->getType(); // the type
            $data['value'] = $condition->getValue(); // the value of the condition
            $data['order'] = $condition->getOrder(); // the order of the condition
            $data['attribute'] = $condition->getAttributes(); // the attributes of the condition, returns an empty [] if no attributes added
        }*/
        
        /* // shipping on cart (whole cart value)
        $conditionName = 'Express Shipping ₹10';
        $data['subTotal'] = round( Cart::getSubTotal(), 2 );
        if(isset($data['subTotal']) && $data['subTotal'] < 500){
            Cart::removeCartCondition($conditionName);
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Express Shipping ₹10',
                'type' => 'shipping',
                'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '+10',
                'order' => 1
            ));
            Cart::condition($condition);
        }else{
            Cart::removeCartCondition($conditionName);
        }*/
        
        return $this->createView('front.cart_list', $data);
    }

    public function AddToCart(Request $request)
    {
        //dd($request);
        //$slug = Helper::destructSlug($slug);
        $id = $request->id;
        if(isset($request->variant_id) && !empty($request->variant_id)){
            $variant_id = $request->variant_id;
            $product_id = $id .'_'. $variant_id;
            $variant = ProductAttribute::find($variant_id);
            //$variant = ProductAttribute::with(['productAttributeImage'])->where('product_id',$product->id)->get();
            $name = $variant->product->product;
            $price = $variant->price;
            $discount = $variant->discount;
            $shipping = $variant->product->shipping_cost;
            $slug = $variant->product->slug;
            //dd($variant);
        }else{
            $product_id = $id;
            $product = Product::with('productDetail')->find($id);
            $name = $product->product;
            $price = $product->price;
            $discount = $product->discount;
            $shipping = $product->shipping_cost;
            $slug = $product->slug;
            //dd($product);
        }
        
        $slug = Helper::constructSlug($slug);
        $quantity = $request->quantity;
        $submit = $request->submit;
        //die();
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        
            // lets create first our condition instance
            $discount_on = new \Darryldecode\Cart\CartCondition(array(
                'name' => "SALE $discount%",
                'type' => "price",
                'value' => "-$discount%"
            ));
            /*
            // shipping on item wise
            $shipping_name = "Shipping ₹$shipping";
            //Cart::removeItemCondition($product_id, $shipping_name);
            $shipping_on = new \Darryldecode\Cart\CartCondition(array(
                'name' => $shipping_name,
                'type' => "shipping",
                'value' => "+$shipping"
            ));*/

            Cart::add(
                array(
                    'id' => $product_id,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'attributes' => array(
                        'size' => 'L',
                        'color' => 'blue'
                    ),
                    'conditions' =>[$discount_on],
                    'associatedModel' => 'products'
                )
            );

            $data['subTotal'] = round( Cart::getSubTotal(), 2 );
            $shipping_name = "Shipping ₹$shipping";
            $shipping_cost = 50;   
            if(isset($data['subTotal']) && $data['subTotal'] < 500){
                $data['cart_list'] = $cartCollection = Cart::getContent();
                $data['count'] = $cartCollection->count();
                $conditions = Cart::getConditions();
                $data['type'] = [];
                if(isset($conditions) && !empty($conditions)){
                    foreach($conditions as $condition){
                        $data['type'][$condition->getType()] = $condition->getType(); // the type
                    }
                }
                if( !in_array('shipping', $data['type']) ){
                    $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => $shipping_name,
                        'type' => 'shipping',
                        'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                        'value' => "+$shipping",
                    ));
                    Cart::condition($condition);
                }
            }else{
                Cart::removeCartCondition($shipping_name);
            }
                
        } 
        if( isset( $submit ) && $submit == 'buyNow' ){
            return redirect()->route('order');
        } else {
            return redirect()->route('product_detail', [$slug]);
        }
    }

    public function RemoveFromCart(Request $request)
    {
        $product_id = $request->product_id;
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        Cart::remove($product_id);
    }

    public function updateCart(Request $request)
    {
        $qty = $request->quantity;
        $product_id = $request->product_id;
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        Cart::update($product_id, 
            array(
                'quantity' => $qty, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
            )
        );
    }

    public function applyCoupon(Request $request)
    {
        //dd($request);
        $code = $request->code;
        $today = date('Y-m-d H:i:s', time());
        $coupon = Coupon::WHERE('code', $code)->WHERE('status', 1)->WHERE('quantity', '>' , 0)->WHERE('start_date', '<' , $today )->WHERE('end_date', '>' , $today)->first();
        $flag = false;
        if( isset( $coupon->code ) && !empty( $coupon->code ) ){
            $name = $coupon->name;
            $code = $coupon->code;
            if( isset( $coupon->discount_type ) && strtolower($coupon->discount_type) == 'fixed' ){
                $value = '-'.$coupon->amount;
            }else{
                $value = '-'.$coupon->amount.'%';
            }
            $flag = true;
        }
        
        $res = 0;
        if($flag == true){
            if (Auth::check()) {
                $userId = Auth::user()->uuid;
                Cart::session($userId);
                $data['cart_list'] = $cartCollection = Cart::getContent();
                // count carts contents
                $data['count'] = $cartCollection->count();
            }            
            $conditions = Cart::getConditions();
            $data['type'] = [];
            if(isset($conditions) && !empty($conditions)){
                foreach($conditions as $condition){
                    $data['type'][$condition->getType()] = $condition->getType(); // the type
                }
            }    
            if( !in_array('coupon', $data['type']) ){
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => $code,
                    'type' => 'coupon',
                    'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => $value,
                ));
                Cart::condition($condition);
                $update_qty = ( $coupon->quantity ) - 1;
                $saved = Coupon::updateOrCreate( [ 'id'=>$coupon->id ],[ 'quantity' => $update_qty ] );
                $res = 1;
            }else{
                $res = 2;
            }
        }  
        echo $res;  
    }

    public function removeCoupon(Request $request)
    {
        $couponName = $code = $request->couponName;
        $coupon = Coupon::WHERE('code', $code)->first();
        $res = 0;
        if(isset($coupon) && !empty($coupon)){
            $flag = true;
        }else{
            $flag = false;
        }
        if($flag == true){
            if (Auth::check()) {
                $userId = Auth::user()->uuid;
                Cart::session($userId);
                $data['cart_list'] = $cartCollection = Cart::getContent();
                // count carts contents
                $data['count'] = $cartCollection->count();
            }            
            $conditions = Cart::getConditions();
            foreach($conditions as $condition){
                $data['type'][$condition->getType()] = $condition->getType(); // the type
            }
           
            if( in_array('coupon', $data['type']) ){
                Cart::removeCartCondition($couponName);
                $update_qty = ( $coupon->quantity ) + 1;
                $saved = Coupon::updateOrCreate( [ 'id'=>$coupon->id ], [ 'quantity' => $update_qty ] );
                $res = 1;
            }
        }  
        echo $res;  
    }
}
