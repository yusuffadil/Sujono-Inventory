<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function authenticate(Request $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('/home')->with('success', 'Login Berhasil');
        } 
        else
        {
            return redirect()->intended('/')->with('error', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
