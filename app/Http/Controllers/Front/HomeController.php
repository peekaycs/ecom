<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Http\Classes\EcomController;
use Cart;

use Illuminate\Support\Facades\DB;
// use Darryldecode\Cart\Facades\CartFacade;

class HomeController extends EcomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        
        $data['best_selling'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'order', 'ASC' )->get();
        $data['topRating'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'order', 'ASC' )->get();
         
        /*$data['topRating'] = $topRating = DB::table('products AS P') 
            ->leftJoin('order_details AS OD', 'P.id', '=', 'OD.product_id')
            ->select('P.*', count('OD.product_id'))
            ->groupBy('OD.product_id')
            ->having(count('OD.product_id'), '>=', 5)
            ->get();
        dd($topRating);
        */

        $data['latest'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'created_at', 'DESC' )->get();
        $data['feature'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->WHERE( 'featured',  1 )->orderBy( 'order','DESC' )->get();
        
        $banners = Banner::where('status', '1')->with('bannerImages')->get();
        foreach($banners as $banner){
            $data[$banner->type] = $banner;
        }
        
        
        //$data['count'] = getTotalQuantity();
        return $this->createView('front.index', $data);
        // return view('front.index', $data);
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

    public function signup(Request $request){
        return view('front.signup');
    }
}
