<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\CartCondition;

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
        //dd($data['cart_list']);
        return view('front.cart_list', $data);
    }

    public function AddToCart(Request $request)
    {
        //
        $slug = str_replace(' ','-',$request->slug);
        // add multiple items at one time
        $userId = 100; // or any string represents user identifier
        Cart::session($userId);
        // lets create first our condition instance
        $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 15%',
            'type' => 'price',
            'value' => '-15%',
        ));
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Express Shipping ₹15',
            'type' => 'shipping',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '+15',
            'order' => 1
        ));
        Cart::condition($condition);

        Cart::add(
            array(
                'id' => 101,
                'name' => 'Sample Item 1',
                'price' => 100,
                'quantity' => 1,
                'attributes' => array(
                    'size' => 'L',
                    'color' => 'blue'
                ),
                'conditions' => $saleCondition,
                'associatedModel' => 'product'
            )
        );

        return redirect()->route('product_detail', [$slug]);
    }
}
