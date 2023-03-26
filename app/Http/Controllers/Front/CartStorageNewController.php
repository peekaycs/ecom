<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\CartCondition;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Brand;
use Image;
use File;
use DB;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;

class CartStorageNewController extends Controller
{
    public function cart_list()
    {
        //
        $data = [];
        $data['category'] = Category::All();
        $data['popular_health'] = Product::All();

        $userId = 100; // or any string represents user identifier
        Cart::session($userId);
        $data['cart_list'] = $cartCollection = Cart::getContent();
        $data['count'] = $cartCollection->count();
        //$data['count'] = getTotalQuantity();
        
        $data['conditions'] = $conditions = Cart::getConditions();
        /*foreach($cartConditions as $condition){
            $data['target'] = $condition->getTarget(); // the target of which the condition was applied
            $data['name'] = $condition->getName(); // the name of the condition
            $data['type'] = $condition->getType(); // the type
            $data['value'] = $condition->getValue(); // the value of the condition
            $data['order'] = $condition->getOrder(); // the order of the condition
            $data['attribute'] = $condition->getAttributes(); // the attributes of the condition, returns an empty [] if no attributes added
        }*/
        $data['subTotal'] = Cart::getSubTotal();
        $data['total'] = Cart::getTotal();
        //dd($data['total']);
        return view('front.cart_list', $data);
    }

    public function AddToCart(Request $request)
    {
        $slug = str_replace('-',' ',$request->slug);
        $product_id = Str::uuid();
        //$user_id = Auth::user()->uuid;
        $userId = 100; // or any string represents user identifier
        Cart::session($userId);

        // lets create first our condition instance
        $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => "SALE $request->discount %",
            'type' => "price",
            'value' => "-$request->discount%",
        ));

        Cart::add(
            array(
                'id' => 101,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'size' => 'L',
                    'color' => 'blue'
                ),
                'conditions' => $saleCondition,
                'associatedModel' => 'products'
            )
        );
        $conditionName = 'Express Shipping ₹10';
        Cart::removeCartCondition($conditionName);
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Express Shipping ₹10',
            'type' => 'shipping',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '+10',
            'order' => 1
        ));
        Cart::condition($condition);

        return redirect()->route('product_detail', [$slug]);
    }
}
