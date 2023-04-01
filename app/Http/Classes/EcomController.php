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
        
        // categories
        $category = Category::All();
        // dynamic pages
        $pages = Page::where('published', true)->get();
        // dd($pages->take(1));
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