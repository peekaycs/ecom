<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.login');
        return redirect(RouteServiceProvider::HOME)->with('view_login_form','view login from');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->session()->regenerate();
        if(!empty($request->redirect_url)){
            redirect()->setIntendedUrl($request->redirect_url);
        }
    
        $request->authenticate();
        if(Auth::check()){
            $userProfile = User::with('userProfile')->find(Auth::user()->id);
            Auth::user()->userProfile = $userProfile;
            if(Auth::user()->user_type == 'admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
                exit;
            }
            if(url()->previous() == route('signup')){
                return redirect(url()->previous());
            }else{
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
