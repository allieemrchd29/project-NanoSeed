<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('logout','Logout Berhasil!');
    }

    //dashboard admin
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }
    
    public function kampanye() {
    $admin = Auth::guard('admin')->user();
    return view('admin.kampanye', compact('admin'));
    }

    public function donasi() {
    $admin = Auth::guard('admin')->user();
    return view('admin.donasi', compact('admin'));
    }

      public function dampak() {
    $admin = Auth::guard('admin')->user();
    return view('admin.dampak', compact('admin'));
    }

      public function dokumentasi() {
    $admin = Auth::guard('admin')->user();
    return view('admin.dokumentasi', compact('admin'));
    }
}
