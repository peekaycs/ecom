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
        $data['orders'] = $orders = Order::WHERE( 'user_id', $userId )->get();
        //dd($user);
        return $this->createView('front.profile',$data);
    }    
}
