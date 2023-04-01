<?php 

namespace App\Http\Classes;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\Category;
use Cart;
class EcomController extends Controller{

   
    
    public function __construct(){
    }

    public function createView($page, $data = array()) {
        // echo '<pre>';
        // print_r($data['main']);die;
        // categories
        $category = Category::All();
        // dynamic pages
        $pages = Page::where('published', true)->get();
        // Cart Items
        $userId = 100; // or any string represents user identifier
        Cart::session($userId);
        $cartCollection = Cart::getContent();
        // count carts contents
        $data['count'] = $cartCollection->count();
        $data['category'] = $category;
        $data['pages'] = $pages;
        return view($page, $data);
    }

}