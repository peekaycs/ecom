<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    //

    public function index(Request $request){
        $user = User::find(Auth::user()->id);
        return view('admin.profile', array('user' => $user));
    }

}
