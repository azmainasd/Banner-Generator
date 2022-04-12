<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view("backend.auth.login");
    }

    public function login(Request $request){
        // return $request->all();
        $request->validate([
            'userName' => 'required|max:50',
            'password' => 'required|min:6|max:50'
        ]);

        $credentials = request(['userName' , 'password']);
        if(Auth::attempt($credentials)){
            Session::flash('success', 'Logged in successfully!');
            return redirect()->intended(route('home'));
            // return redirect()->intended(route('banners.index'));
        }else{
            Session::flash('error', 'Invalid credentials!');
            return back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}
