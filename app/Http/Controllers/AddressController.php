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
use Session;

class AddressController extends EcomController
{
    //
    public function index(Request $request){

        $data = [];
        //cart detail
        $product_ids = $attribute_ids = [];        
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            $data['addresses'] = $addresses = Address::WHERE('user_id',$userId)->get();
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
        $data['subTotal'] = Cart::getSubTotal() ? floor(Cart::getSubTotal()) :0;
        $data['total'] = Cart::getTotal();        
        $data['conditions'] = $conditions = Cart::getConditions();
        //end
        
        $data['order_id'] = $order_id = Session::get('order_id');
        //echo $order_id = $request->session()->get('order_id');
        //echo $order_id = session('order_id');
    
        return $this->createView('front.address', $data);
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:2'],
            'contact' => ['required', 'numeric', 'min:10'],
            'landmark' => 'nullable|string',
            'address' => ['required', 'string', 'max:500'],
            'optradio' => ['required', 'string'],
            'zip' => ['required', 'integer', 'min:6'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string']
        ]);
        $uuid = Str::uuid();
        $user_id = Auth::user()->uuid;
        $addresses = Address::WHERE('user_id',$user_id)->get();
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
            'landmark' => $request->landmark,
            'address' => $request->address,
            'address_type' => $request->optradio,
            'default_address' => $default_address,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state
        ]);

        if(isset($request->default_address) && !empty($request->default_address)){
            DB::update('update addresses set default_address = ? where user_id = ?',[0, $user_id ]);
            $address = Address::updateOrCreate( [ 'uuid'=>$uuid ], [ 'default_address' => 1] );
        }
        
        if( !isset( $request->profile ) || empty( $request->profile ) ){
            if($address)
                return redirect(route('address'))->with('success','Address saved successfully');
            else
                return redirect(route('address'))->with('error','Can\'t save address, please try again later');
        }else{
            if($address)
                return redirect(route('user-profile'))->with('success','Addredd updated successfully');
            else
                return redirect(route('user-profile'))->with('error','Can\'t update address');
        }        
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:2'],
            'contact' => ['required', 'numeric', 'min:10'],
            'landmark' => 'nullable|string',
            'address' => ['required', 'string', 'max:500'],
            'optradio' => ['required', 'string'],
            'zip' => ['required', 'integer', 'min:6'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string']
        ]);
        
        $address = Address::updateOrCreate( 
            [ 
                'uuid'=>$request->uuid 
            ],
            [ 
                'name' => $request->name,
                'contact' => $request->contact,
                'landmark' => $request->landmark,
                'address' => $request->address,
                'address_type' => $request->optradio,
                'zip' => $request->zip,
                'city' => $request->city,
                'state' => $request->state 
            ] 
        );
        
        if(isset($request->default_address) && !empty($request->default_address)){
            //dd($request);
            $user_id = Auth::user()->uuid;
            DB::update('update addresses set default_address = ? where user_id = ?',[0, $user_id ]);
            $address = Address::updateOrCreate( [ 'uuid'=>$request->uuid ], [ 'default_address' => 1] );
        }

        if( !isset( $request->profile ) || empty( $request->profile ) ){
            if($address)
                return redirect(route('address'))->with('success','Addredd updated successfully');
            else
                return redirect(route('address'))->with('error','Can\'t update address');
        }else{
            if($address)
                return redirect(route('user-profile'))->with('success','Addredd updated successfully');
            else
                return redirect(route('user-profile'))->with('error','Can\'t update address');
        }        
    }

    public function makeDefault(Request $request, $uuid)
    {
        //dd($request);
        $userId = Auth::user()->uuid;
        DB::update('update addresses set default_address = ? where user_id = ?',[0, $userId ]);
        //$address = Address::updateOrCreate( [ 'user_id'=>$userId ], [ 'default_address' => 0] );
        $address = Address::updateOrCreate( [ 'uuid'=>$uuid ], [ 'default_address' => 1] );
        
        if( !isset( $request->ajax ) || empty( $request->ajax ) ){
            if($address)
                return redirect(route('address'))->with('success','Address marked as default successfully');
            else
                return redirect(route('address'))->with('error','Can\'t save address as default');
        }else{
            echo 1;
        }        
    }

    public function remove(Request $request, $id)
    {
        $address = Address::find($id);
        $saved = 0;
        if($address->user_id == Auth::user()->uuid){
            $ok = true;
        }else{
            $ok = false;
        } 
        if($ok) {
            $saved = Address::where('uuid', $id)->firstorfail()->delete();
        }

        if( isset( $request->ajax ) && !empty( $request->ajax ) ){
            echo $ok;
        } 
    }

    public function getAddress(Request $request, $id)
    {
        $address = Address::find($id);
        if($address->user_id == Auth::user()->uuid){
            $ok = true;
        }else{
            $ok = false;
        }  

        if( isset( $request->ajax ) && !empty( $request->ajax ) ){
            if($ok){
                echo json_encode($address);
            }else{
                echo $ok;    
            }   
        } 
    }
}
