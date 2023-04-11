<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\EcomController;

use App\Models\Address;
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

class AddressController extends EcomController
{
    //
    public function index(Request $request){
        $data = [];
        $data['addresses'] = $addresses = Address::all();
        //dd($addresses);
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
        $data['subTotal'] = Cart::getSubTotal();
        $data['total'] = Cart::getTotal();        
        $data['conditions'] = $conditions = Cart::getConditions();
        //end
    
        return $this->createView('front.address', $data);
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'string',
            'contact' => 'string',
            'email' => 'email',
            'landmark' => 'string',
            'address' => 'string',
            'optradio' => 'string',
            'zip' => 'integer',
            'city' => 'string',
            'state' => 'string'
        ]);
        
        $uuid = Str::uuid();
        $user_id = Auth::user()->uuid;
        $addresses = Address::all();
        if(isset($addresses) && $addresses->count() > 0){
            $default_address = 0;
        }else{
           $default_address = 1;
        }
        $address = Address::create([
            'uuid' => $uuid,
            'user_id' => $user_id,
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'landmark' => $request->landmark,
            'address' => $request->address,
            'address_type' => $request->optradio,
            'default_address' => $default_address,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state
        ]);
        
        
        if($address)
            return redirect(route('address'))->with('success','Product saved successfully');
        else
            return redirect(route('address'))->with('error','Can\'t save product');
    }
}
