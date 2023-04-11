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

class CheckoutController extends EcomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data['subTotal'] = Cart::getSubTotal();
        $data['total'] = Cart::getTotal();        
        $data['conditions'] = $conditions = Cart::getConditions();
        //end
        return $this->createView('front.checkout',$data);
        
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
