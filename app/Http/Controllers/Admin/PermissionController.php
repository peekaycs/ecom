<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    protected $guard = 'web';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.permissions', array('permissions' => $permissions));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:roles'
        ]);

        $saved = Permission::create(
            [
                'name' => $request->name,
                'guard_name' => $this->guard,
                'description' => $request->description
            ]
        );
        if($saved)
            return redirect(route('create-permission'))->with('success','Permission created successfully');
        else
        return redirect(route('create-permission'))->with('error','Can\'t create this permission');
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
        $permission = Permission::find($id);
        return view('admin.edit-permission', array('permission'=>$permission));
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
        $permission = Permission::find($id);
        $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($permission)]
        ]);

        $saved = $permission->update(array_merge($request->all(),['guard_name' => $this->guard]));
        if($saved)
            return redirect(route('edit-permission',$id))->with('success','Permission edited successfully');
        else
            return redirect(route('edit-permission',$id))->with('error','Can\'t edit this permission');
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
