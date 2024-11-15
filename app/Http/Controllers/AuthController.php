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
            return redirect()->intended(route('customer.dashboard'))->with('success');
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('admins')->with('success', 'Logged in successfully as Admin');
        } elseif (Auth::guard('hotel_manager')->attempt($credentials)) {
            return redirect()->intended('home')->with('success', 'Logged in successfully as Hotel Manager');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome')->with('success', 'Logged out successfully');
    }
}