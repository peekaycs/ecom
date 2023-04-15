<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Classes\EcomController;

use App\Models\Address;
use App\Models\Order;
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

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'total' => 'integer',
            'discount' => 'integer|nullable',
            'applied_coupon' => 'integer|nullable',
        ]);
        
        $uuid = Str::uuid();
        $user_id = Auth::user()->uuid;
        
        $order = Order::create([
            'id' => $uuid,
            'user_id' => $user_id,
            'total' => $request->total,
            'discount' => $request->discount,
            'applied_coupon' => $request->applied_coupon,
        ]);
        
        if($order)
            return redirect(route('address'))->with('success','Product saved successfully');
        else
            return redirect(route('address'))->with('error','Can\'t save product');
    }
}
