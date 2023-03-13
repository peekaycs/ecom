<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rule;
class RoleController extends Controller
{
    //

    protected $guard = 'web';

    public function index(Request $request){
        $roles = Role::paginate(env('PER_PAGE'));

        return view('admin.roles', array('roles' => $roles));
    }


    public function create(Request $request){
        return view('admin.create-role');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|unique:roles'
        ]);

        $saved = Role::create(
            [
                'name' => $request->name,
                'guard_name' => $this->guard,
                'description' => $request->description
            ]
        );
        if($saved)
            return redirect(route('roles'))->with('success','Role created successfully');
        else
        return redirect(route('roles'))->with('error','Can\'t create this role');
    }

    public function edit(Request $request, $id){
        $role = Role::find($id);

        return view('admin.edit-role', array('role' => $role));
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($role)]
        ]);

        $saved = $role->update(array_merge($request->all(),['guard_name' => $this->guard]));
        if($saved)
            return redirect(route('edit-role',$id))->with('success','Role edited successfully');
        else
            return redirect(route('edit-role',$id))->with('error','Can\'t edit this role');
    } 
}
