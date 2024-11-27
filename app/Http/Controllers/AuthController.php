<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(){
        return view('user.login');
    }



    public function authenticate(Request $request){
        $credentials = $request->validate([
        'password' => 'required',
        'email' => 'required|email'
        ]);
        $remeber = $request->has('remember');

        if(Auth::attempt($credentials, $remeber)){
            $request->session()->regenerate();
            
            return redirect()->intended('user/dashboard');
        }

    
        return back()->withErrors([
            'message' => 'the provided credentails dont match our'
        ]);
    }
}
