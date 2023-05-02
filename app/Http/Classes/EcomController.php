<?php 

namespace App\Http\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Page;
use App\Models\Category;
use Cart;
class EcomController extends Controller
{
    public $pageTitle = '';
    public function __construct(){
        
    }

    public function createView($page, $data = array()) {
        
        // categories
        $category = Category::WHERE( 'status', 1 )->WHERE( 'visibility', 1 )->orderBy('order','ASC')->get();
        // dynamic pages
        $pages = Page::where('published', true)->get();
        // Cart Items
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
            Cart::session($userId);
            $data['cart_list'] = $cartCollection = Cart::getContent();
            // count carts contents
            $data['count'] = $cartCollection->count();
        }
        
        $data['category'] = $category;
        $data['pages'] = $pages;
        $data['pageTitle'] = $this->pageTitle;
        return view($page, $data);
    }



}