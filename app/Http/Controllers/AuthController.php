<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('home')->with('success', 'Logged in successfully as Customer');
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('home')->with('success', 'Logged in successfully as Admin');
        } elseif (Auth::guard('hotel_manager')->attempt($credentials)) {
            return redirect()->intended('home')->with('success', 'Logged in successfully as Hotel Manager');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully');
    }
}