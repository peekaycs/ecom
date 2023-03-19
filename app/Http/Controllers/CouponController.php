<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons = Coupon::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.coupons', array('coupons' => $coupons));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-coupon');
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

        $request->validate([
            'name' =>   ['required','string','min:3','max:255', Rule::unique('coupons')],
            'code' => ['required','string','min:3','max:20', Rule::unique('coupons')],
            'amount' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            'discount_type' => ['required','string'],
            'description' => ['nullable','string'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date'],
            'status'    => ['required','boolean'],
        ]);

        $saved = Coupon::create(array_merge(['id' => Str::uuid()],$request->all()));
        if($saved)
            return redirect(route('create-coupon'))->with('success','Coupon created successfully');
        else
        return redirect(route('create-coupon'))->with('error','Can\'t create coupon');
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
    public function edit(Request $request, $id)
    {
        //
        $coupon = Coupon::find($id);
        return view('admin.edit-coupon', array('coupon'=>$coupon));
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
        $request->validate([
            'name' =>   ['required','string','min:3','max:255', Rule::unique('coupons')->ignore($id)],
            'code' => ['required','string','min:3','max:20', Rule::unique('coupons')->ignore($id)],
            'amount' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            'discount_type' => ['required','string'],
            'description' => ['nullable','string'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date'],
            'status'    => ['required','boolean'],
        ]);

        $saved = Coupon::updateOrCreate(['id'=>$id],$request->all());

        if($saved)
            return redirect(route('edit-coupon',$id))->with('success','Coupon updated successfully');
        else
        return redirect(route('edit-coupon',$id))->with('error','Can\'t update coupon');
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
