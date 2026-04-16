<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    // 🔹 Coba login sebagai ADMIN
    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard-admin');
    }

    // 🔹 Coba login sebagai PEMBIMBING
    if (Auth::guard('pembimbing')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard-pembimbing');
    }

    return back()->with('error', 'Username atau password salah')->withInput();
}

public function logout(Request $request)
{
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    }

    if (Auth::guard('pembimbing')->check()) {
        Auth::guard('pembimbing')->logout();
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}
}
