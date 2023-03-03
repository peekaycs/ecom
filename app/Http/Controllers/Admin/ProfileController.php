<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Image;
use File;

class ProfileController extends Controller
{
    //

    public function index(Request $request){
        $user = User::find(Auth::user()->id);
        return view('admin.profile', array('user' => $user));
    }

    public function edit(Request $request){
        $user = User::with('userProfile')->find(Auth::user()->id);
        return view('admin.edit-profile', array('user' => $user));
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'integer','min:10'],
        ]);
        $user = User::with('userProfile')->find(Auth::user()->id);
        // echo $user->first_name;die;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $saved = $user->save();
        if($request->file('image')){
            $image = $request->file('image');
            $input['file'] = Str::lower($request->first_name.Str::random()).'.'.$image->getClientOriginalExtension();
            $filePath = '/images/users/profile/thumbnail';
            $targetPath = public_path($filePath);
            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $userProfile = UserProfile::find($user->userProfile->id);
            $userProfile->image = $filePath.'/'.$input['file'];
            $userProfile->save();
        }
        if($saved){
            return redirect(route('admin-profile-edit'))->with('success','Profile updated successfully');
        }
        return redirect(route('admin-profile-edit'))->with('error','Can\'t update profile');
    }

}
