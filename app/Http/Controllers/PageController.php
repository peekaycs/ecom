<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
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
            'name' => ['required','string','min:3','max:255',Rule::unique('coupons')],
            'slug' => ['required','string','min:3','max:255'],
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
            'name' => ['required','string','min:3','max:255',Rule::unique('coupons')->ignore($id)],
            'slug' => ['required','string','min:3','max:255'],
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
}
