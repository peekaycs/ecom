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
        //
        $data = $product_ids = $attribute_ids = [];
        
        $data['popular_health'] = Product::All();
        
        //$user_id = Auth::user()->uuid;
        //$userId = 100; // or any string represents user identifier
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        //Cart::session($userId);
        //$data['cart_list'] = $cartCollection = Cart::getContent();
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

        // $data['count'] = $cartCollection->count();   //$data['count'] = getTotalQuantity();
        $data['subTotal'] = Cart::getSubTotal();
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
        $slug = str_replace('-',' ',$request->slug);
        $id = $request->id;
        if(isset($request->variant_id) && !empty($request->variant_id)){
            $variant_id = $request->variant_id;
            $product_id = $id .'_'. $variant_id;
        }else{
            $product_id = $id;
        }
        
        //$user_id = Auth::user()->uuid;
        //$userId = 100; // or any string represents user identifier
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        
            //Cart::session($userId);

            // lets create first our condition instance
            $discount = new \Darryldecode\Cart\CartCondition(array(
                'name' => "SALE $request->discount %",
                'type' => "price",
                'value' => "-$request->discount%"
            ));
            // shipping on item wise
            $name = "Shipping ₹$request->shipping";
            Cart::removeItemCondition($product_id, $name);
            $shipping = new \Darryldecode\Cart\CartCondition(array(
                'name' => $name,
                'type' => "shipping",
                'value' => "+$request->shipping"
            ));

            Cart::add(
                array(
                    'id' => $product_id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'attributes' => array(
                        'size' => 'L',
                        'color' => 'blue'
                    ),
                    'conditions' =>[$discount, $shipping],
                    'associatedModel' => 'products'
                )
            );
        }     
        return redirect()->route('product_detail', [$slug]);
    }

    public function RemoveFromCart(Request $request)
    {
        $product_id = $request->product_id;
        //$user_id = Auth::user()->uuid;
        //$userId = 100; // or any string represents user identifier
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        //Cart::session($userId);
        Cart::remove($product_id);
    }

    public function updateCart(Request $request)
    {
        $qty = $request->quantity;
        $product_id = $request->product_id;
        //$user_id = Auth::user()->uuid;
        //$userId = 100; // or any string represents user identifier
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        //Cart::session($userId);
        Cart::update($product_id, 
            array(
                'quantity' => $qty, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
            )
        );
    }

    public function applyCoupon(Request $request)
    {
        //
        $flag = true;
        if($request->code == 12345){
            $value = -20;
        }elseif($request->code == 12345678){
            $value = -10;
        }else{
            $flag = false;
        }
        $res = 0;
        if($flag == true){
            //$user_id = Auth::user()->uuid;
            //$userId = 100; // or any string represents user identifier
            if (Auth::check()) {
                $userId = Auth::user()->uuid;
                Cart::session($userId);
                $data['cart_list'] = $cartCollection = Cart::getContent();
                // count carts contents
                $data['count'] = $cartCollection->count();
            }
            //Cart::session($userId);
            
            $conditions = Cart::getConditions();
            $data['type'] = [];
            if(isset($conditions) && !empty($conditions)){
                foreach($conditions as $condition){
                    $data['type'][$condition->getType()] = $condition->getType(); // the type
                }
            }    
            if( !in_array('coupon', $data['type']) ){
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => 'COUPON CODE',
                    'type' => 'coupon',
                    'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => $value,
                ));
                Cart::condition($condition);
                $res = 1;
            }else{
                $res = 2;
            }
        }  
        echo $res;  
    }

    public function removeCoupon(Request $request)
    {
        //
        $flag = true;
        /*if($request->couponName == 12345){
            $value = -20;
        }elseif($request->couponName == 12345678){
            $value = -10;
        }else{
            $flag = false;
        }*/
        $res = 0;
        $couponName = $request->couponName;
        if($flag == true){
            //$user_id = Auth::user()->uuid;
            //$userId = 100; // or any string represents user identifier
            if (Auth::check()) {
                $userId = Auth::user()->uuid;
                Cart::session($userId);
                $data['cart_list'] = $cartCollection = Cart::getContent();
                // count carts contents
                $data['count'] = $cartCollection->count();
            }
            //Cart::session($userId);
            
            $conditions = Cart::getConditions();
            foreach($conditions as $condition){
                $data['type'][$condition->getType()] = $condition->getType(); // the type
            }
           
            if( in_array('coupon', $data['type']) ){
                Cart::removeCartCondition($couponName);
                $res = 1;
            }
        }  
        echo $res;  
    }
}
