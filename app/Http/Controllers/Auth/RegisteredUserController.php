<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use App\Models\UserProfile;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'integer','min:10',  'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user_id = Str::uuid();
        $user = User::create([
            'first_name' => Str::ucfirst($request->first_name),
            'last_name' => Str::ucfirst($request->last_name),
            'uuid' => $user_id,
            'email' => $request->email,
            'mobile'    => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        UserProfile::create([
            'id' => Str::uuid(),
            'user_id' => $user_id,
        ]);
        Auth::login($user);
        if( isset( $request->user_type ) && !empty( $request->user_type )){
            if(isset($request->last_url)){
                return redirect( $request->last_url);
            }
            return redirect(url()->previous());
        }else{
            return redirect(url()->previous());
        }
        

        return redirect(RouteServiceProvider::HOME);
    }
}
