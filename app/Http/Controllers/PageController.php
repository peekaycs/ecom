<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumSpace;
use App\Http\Classes\EcomController;

class PageController extends EcomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.pages',array('pages' => $pages ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-page');
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
            'name' => ['required','string','min:3','max:255',Rule::unique('pages')],
            'slug' => ['required','string', new AlphaNumSpace, 'min:3','max:255',Rule::unique('pages')],
            'title' => ['required','string','min:3','max:255'],
            'content' => ['required','string','min:3'],
            'published' => ['required','boolean']
        ]);

        $saved = Page::create(array_merge(['id'=>Str::uuid()],$request->all()));
        if($saved)
            return redirect(route('create-page'))->with('success','Page created successfully');
        else
            return redirect(route('create-page'))->with('error','Can\'t create page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        //
        $slug = Helper::destructSlug($slug);
        $page = Page::where('slug',$slug)->get()->take(1);
        if(isset($page[0])){
            return $this->createView('front.page', array('pageContent' => $page[0]));
        }
        return redirect()->back();
        

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
        $page = Page::find($id);
        // dd($page);
        return view('admin.edit-page', array('page' => $page));
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
            'name' => ['required','string','min:3','max:255',Rule::unique('pages')->ignore($id)],
            'slug' => ['required','string','min:3','max:255',new AlphaNumSpace,Rule::unique('pages')->ignore($id)],
            'title' => ['required','string','min:3','max:255'],
            'content' => ['required','string','min:3'],
            'published' => ['required','boolean']
        ]);

        $saved = Page::updateOrCreate(['id'=>$id],$request->all());
        if($saved)
            return redirect(route('edit-page',$id))->with('success','Page updated successfully');
        else
            return redirect(route('edit-page',$id))->with('error','Can\'t update page');
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

    public function delete(Request $request, $id){
        Page::find($id)->delete();
        return redirect()->back()->with('success','Page deleted successfully');
    }

    public function disclaimer(Request $request){
        return $this->createView('front.privacy-policy');
    }

    
}
