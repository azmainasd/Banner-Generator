<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showReg(){
        return view("backend.auth.register");
    }

    public function register(Request $request){
        // return $request->all();
        $request->validate([
            'name' => 'required|max:100',
            'userName' => 'required|max:100|unique:users',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:20|confirmed',
        ]);

        $user = New User([
            "name" => $request->name,
            "userName" => $request->userName,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        $user->save();

        Session::flash('success', 'User has been created!');
        return redirect()->route('login');
    }
}