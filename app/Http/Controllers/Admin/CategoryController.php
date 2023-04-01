<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\AlphaNumSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'slug' => ['required', new AlphaNumSpace, Rule::unique('categories')]
        ]);
        $this->validateCategory($request);
        $category = Category::create(
            [
                'uuid' => Str::uuid(),
                'category' =>    $request->category,
                'slug'  =>  $request->slug,
                'description'   => $request->description,
                'status' => $request->status,
                'order' => $request->order,
                'visibility' => $request->visibility,
            ]
        );
        if($category){
            return redirect(route('create-category'))->with('success','Category saved successfully');
           }
           return redirect(route('create-category'))->with('error','Can\'t create category');
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        //
        $category = $category->whereUuid($id)->first();
        
        return view('admin.edit-category', array('category'=> $category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        //
        $request->validate([
            'slug' => ['required',new AlphaNumSpace, Rule::unique('categories')->ignore($id)]
        ]);
        $this->validateCategory($request);

        $category = Category::whereUuid($id)->first();
        $category->category = $request->category;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->order = $request->order;
        $category->visibility = $request->visibility;
        $saved = $category->save();
        if($saved){
            return redirect(route('categories'))->with('success','Category saved successfully');
           }
           return redirect(route('edit-category',$id))->with('error','Can\'t update category');
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

    private function validateCategory($request){
        $request->validate(
            [
                'category' => 'required|string|min:3|max:255',
                'slug' => 'required|string|min:3|max:255',
                'description' => 'string|min:3|max:1000',
                'status' => 'required|boolean',
                'order' => 'required|integer',
                'visibility' => 'required|boolean',
            ]
        );
    }
}
