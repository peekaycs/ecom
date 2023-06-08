<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        
        $data['best_selling'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'order', 'ASC' )->limit(env('PER_PAGE'))->get();
        $data['topRating'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'order', 'ASC' )->limit(env('PER_PAGE'))->get();
         
        /*$data['topRating'] = $topRating = DB::table('products AS P') 
            ->leftJoin('order_details AS OD', 'P.id', '=', 'OD.product_id')
            ->select('P.*', count('OD.product_id'))
            ->groupBy('OD.product_id')
            ->having(count('OD.product_id'), '>=', 5)
            ->get();
        dd($topRating);
        */

        $data['latest'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy( 'created_at', 'DESC' )->limit(env('PER_PAGE'))->get();
        $data['feature'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->WHERE( 'featured',  1 )->limit(env('PER_PAGE'))->orderBy( 'order','DESC' )->get();
        
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
        return $this->createView('front.signup');
    }

    public function forget_password(Request $request){
        return $this->createView('front.forget_password');
    }

    public function reset_password(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;
        $user = User::Where('email', $email)->get();
        if($user){
            $to = $email;
            $subject = "Password Reset";
            $message = "<a href=".route('set_password')."?e=".base64_encode($email).">Click Here to Reset Password.</a>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <arvindpandeymail@gmail.com>' . "\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to, $subject, $message, $headers);
            return back()->with('success', 'Password reset link send to your email id.');
        }else{
            //return redirect(route('forget_password'))->with('success','Email does not exist.');
            return back()->with('success', 'Email does not exist.');
        }
    }

    public function set_password(Request $request){
        return $this->createView('front.reset_password');
    }

    public function save_password(Request $request){
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $email = base64_decode($request->e);
        $password = $request->password;
        $user = User::Where('email', $email)->get();
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password Reset Done Successfully.');
        }else{
            return back()->with('success', 'There was some problem.');
        }
    }
}
