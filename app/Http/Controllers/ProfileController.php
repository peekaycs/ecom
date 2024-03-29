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

use App\Models\Payment;

use Image;
use File;
use DB;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;

use Session;

class ProfileController extends EcomController
{
    //
    public function index(Request $request)
    {
        $userId = Auth::user()->uuid;
        $data['user'] = $user = User::WHERE( 'uuid', $userId )->first();
        $data['addresses'] = $addresses = Address::WHERE( 'user_id', $userId )->get();
        $data['orders'] = $orders = Order::WHERE( 'user_id', $userId )->orderBy('updated_at','DESC')->get();

        $product = $product_attribute = [];
        if(isset($orders) && !empty($orders)){
            foreach($orders as $order){
                if(isset($order->orderDetails) && !empty($order->orderDetails)){
                    foreach($order->orderDetails as $orderDetail){
                        if(isset($orderDetail->product_attribute_id) && !empty($orderDetail->product_attribute_id)){
                            $product[$order->id][$orderDetail->product_id] = Product::find($orderDetail->product_id);
                            $product_attribute[$order->id][$orderDetail->product_attribute_id] = ProductAttribute::find($orderDetail->product_attribute_id);
                        }elseif(isset($orderDetail->product_id) && !empty($orderDetail->product_id)){
                            $product[$order->id][$orderDetail->product_id] = Product::find($orderDetail->product_id);
                        } 
                    }
                }           
            }
            //dd($product);
            $data['product'] = $product;
            $data['product_attribute'] = $product_attribute;
        }

        return $this->createView('front.profile', $data);
    } 
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'min:2'],
            'mobile' => ['required', 'integer', 'min:10', Rule::unique('users')->ignore($user)],
            'last_name' => ['nullable', 'string', 'max:50', 'min:2'],
            'middle_name' => ['nullable', 'string', 'max:50', 'min:2'],
            'email' => ['required', 'email', 'string', Rule::unique('users')->ignore($user)]  
        ]);
        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $saved = $user->save();
        if($saved){
            //Session::flash('msg', 'User updated successfully'); 
            return redirect(route('user-profile'))->with('success','User updated successfully');
        }else{
            //Session::flash('msg', 'Can\'t update user'); 
            //Session::flash('alert-class', 'alert-danger'); 
            return redirect(route('user-profile'))->with('error','Can\'t update user');
        }    
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        //$old_password = Hash::make($request->old_password);
        $ok = false;
        if(Hash::check($request->old_password, Auth::user()->password)){
            $ok = true;
            $password = Hash::make($request->password);
            $user = User::find(Auth::user()->id);
            $user->password = $password;
            $saved = $user->save();
        }
        if($ok){
            if($saved){
                return redirect(route('user-profile'))->with('success','Password updated successfully');
            }else{
                return redirect(route('user-profile'))->with('error','Can\'t update password');
            }
        }else{
            return redirect(route('user-profile'))->with('error','Wrong old password');
        }
    }

}
