<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.categories',array('categories' => $categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        

        return view('admin.create-category');
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
        $request->validate(
            [
                'category' => 'required|string|min:3|max:255|unique:categories',
                'slug' => 'required|string|min:3|max:255|unique:categories',
                'description' => 'string|min:3|max:1000',
                'status' => 'required|boolean',
                'order' => 'required|integer',
                'visibility' => 'required|boolean',
            ]
        );

        $category = Category::create(
            [
                'uuid' => Str::uuid(),
                'category'  =>  $request->category,
                'slug'  =>  $request->slug,
                'description'   => $request->description,
                'status' => $request->status,
                'order' => $request->order,
                'visibility' => $request->visibility,
            ]
        );
        if($category){
            return redirect(route('create-category'))->with('success','Attribute group saved successfully');
           }
           return redirect(route('create-category'))->with('error','Can\'t create attribute group');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $id)
    {
        //
        // dd($category);
        echo $id;
        $category = $category->whereUuid('uuid',$id);
        dd($category);
        return view('admin.show-category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
