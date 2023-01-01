<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    // fungsi authentication sebelum login
    public function authenticate( Request $request ){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'

        ]);

        if( Auth::attempt($credentials) ){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed');
    }


    // fungsi logout
    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }


}
