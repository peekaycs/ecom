<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.brands',array('brands' => $brands));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-brand');
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
            'brand' => 'required|unique:brands',
            'description' => 'nullable|max:255',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0'
        ]);
       
        if(Brand::create(array_merge($request->only('brand','description','status','order'),['id' => Str::uuid()]))){
            return redirect(route('create-brand'))->with('success','Brand created successfully');
        }else{
            return redirect(route('create-brand'))->with('error','Error creating brand');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brands  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand, $id)
    {
        //
        $brand = Brand::find($id);
        return view('admin.edit-brand', array('brand' => $brand));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand,$id)
    {
        //
        $brand = Brand::find($id);
        $saved = $brand->update($request->all());
        if($saved){
            return redirect(route('edit-brand',$id))->with('success','Brand uodated successfully');
        }else{
            return redirect(route('edit-brand',$id))->with('error','Error updating brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

    public function delete(Request $request, $id){
        Brand::find($id)->delete();
        return redirect()->back()->with('success','Attribute group deleted successfully');

   }
}
