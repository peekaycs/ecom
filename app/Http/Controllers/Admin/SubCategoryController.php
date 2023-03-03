<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subCategories = SubCategory::with('category')->paginate(env('PER_PAGE'));
        // dd($subCategories);
        return view('admin.subcategories',array('subCategories' => $subCategories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.create-subcategory',array('categories' => $categories));
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
        $this->validateSubCategory($request);
        // echo $request->category_id;die;
        $subCategory = SubCategory::create([
            'uuid' => Str::uuid(),
            'category_id' => $request->category,
            'subcategory' => $request->subcategory,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'order' => $request->order,
            'visibility' => $request->visibility

        ]);

        if($subCategory){
            return redirect(route('create-subcategory'))->with('success', 'Subcategory created successfully');
        }else{
            return redirect(route('create-subcategory'))->with('error', 'Can\'t create subcategory');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory, $id)
    {
        //
        $categories = Category::all();
        $subCategory = $subCategory->whereUuid($id)->first();
        
        return view('admin.edit-subcategory', array('subCategory'=> $subCategory,'categories'=>$categories));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory, $id)
    {
        //
        $this->validateSubCategory($request);

        $subCategory = SubCategory::whereUuid($id)->first();
        $subCategory->subcategory = $request->subcategory;
        $subCategory->category_id = $request->category;
        $subCategory->slug = $request->slug;
        $subCategory->description = $request->description;
        $subCategory->status = $request->status;
        $subCategory->order = $request->order;
        $subCategory->visibility = $request->visibility;
        $saved = $subCategory->save();
        if($saved){
            return redirect(route('subcategories'))->with('success','Sub category saved successfully');
        }
        return redirect(route('edit-category',$id))->with('error','Can\'t update sub category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }

    private function validateSubCategory($request){
        $request->validate(
            [
                'category' => 'required',
                'subcategory' => 'required|string|min:3|max:255',
                'slug' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:3|max:255',
                'status' => 'required|boolean',
                'order' => 'required|integer|min:0',
                'visibility' => 'required|boolean'
    
            ]
        );
    }
}
