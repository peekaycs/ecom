<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UserProfile;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('user_type','vendor')->paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.vendor-users', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $roles = Role::all();
        // $permissions = Permission::all();
        return view('admin.create-vendor-user');
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
                'first_name' => 'required|string|min:2|max:50',
                'middle_name' => 'nullable|string|min:2|max:50',
                'last_name' => 'nullable|string|min:2|max:50',
                'email' => 'required|email|unique:users',
                'mobile' => 'nullable|integer|',
                'age' => 'nullable|integer',
                'gender' => 'nullable|string',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]
        );

        $password = Hash::make($request->password);
        $userId = Str::uuid();
        $saved = User::create(array_merge($request->all(),['uuid'=> $userId,'password' => $password,'user_type'=>'vendor']));
        UserProfile::create(array_merge($request->all(),['id'=> Str::uuid(),'user_id'=> $userId]));
        if($saved)
            return redirect(route('create-vendor-user'))->with('success','User created successfully');
        else
            return redirect(route('create-vendor-user'))->with('error','Can\'t create user');
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

        $user = User::with(['userProfile'])->find($id);
        
        return view('admin.edit-vendor-user', array('user' => $user));
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
        $user = User::with('userProfile')->find($id);
        // dd($user);
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => ['required', 'email','string',Rule::unique('users')->ignore($user)],
            'mobile' => ['required', 'integer',Rule::unique('users')->ignore($user)],
            'age' => 'nullable|integer',
            'gender' => 'required',
            'is_active' => 'required|boolean'
        ]);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->is_active =   $request->is_active;
        $saved = $user->save();
        if($saved){
            $userProfile = UserProfile::find($user->userProfile->id);
            // dd($userProfile);
            $userProfile->age = $request->age;
            $userProfile->gender = $request->gender;
            $userProfile->save();
        }
        
        if($saved)
            return redirect(route('edit-vendor-user', $id))->with('success','User updated successfully');
        else
            return redirect(route('edit-vemdor-user',$id))->with('error','Can\'t update user');

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
