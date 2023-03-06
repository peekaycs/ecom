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
use App\Models\Address;
use File;

class ProfileController extends Controller
{
    //

    public function index(Request $request){
        $user = User::with('userProfile','userAddress')->find(Auth::user()->id);
        return view('admin.profile', array('user' => $user));
    }

    public function edit(Request $request){
        $user = User::with('userProfile','userAddress')->find(Auth::user()->id);
        return view('admin.edit-profile', array('user' => $user));
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'integer','min:10'],
            'gender' => ['required'],
            'address' => ['nullable','string', 'max:255','min:3'],
            'city' => ['nullable','string', 'max:255','min:3'],
            'state' =>  ['nullable','string', 'max:255','min:3'],
            'image' => ['nullable','image', 'mimes:jpeg,jpg,png','max:1024']    
        ]);
        $user = User::with('userProfile','userAddress')->find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $saved = $user->save();
       
        $ProfileImage = null;
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
           
            $ProfileImage = $filePath.'/'.$input['file'];
        }
        if(isset($user->userProfile->id)){
            $userProfile = UserProfile::find($user->userProfile->id);
        
            $userProfile->age = $request->age;
            $userProfile->gender = $request->gender;
            if(!empty($ProfileImage)){
                $userProfile->image = $ProfileImage;
            }
            $userProfile->save();
        }else{
            $profileArray = [
                'id' => Str::uuid(),
                'user_id' => $id,
                'age' => $request->age,
                'gender' => $request->gender,
            ];
            if(!empty($ProfileImage)){
                $profileArray['image'] = $ProfileImage;
            }
            UserProfile::create($profileArray);
        }
        // user address
        
        if(isset($user->userAddress[0]->uuid)){
            $address = Address::find($user->userAddress[0]->uuid);
            $address->address = $request->address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->save();
        }else{
            Address::create([
                'uuid'   => Str::uuid(),
                'user_id' => $id,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
            ]);
        }


        if($saved){
            return redirect(route('admin-profile-edit'))->with('success','Profile updated successfully');
        }
        return redirect(route('admin-profile-edit'))->with('error','Can\'t update profile');
    }

}
