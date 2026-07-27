<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

        // 🔹 Coba login sebagai PEMBIMBING ASAL
        if (Auth::guard('pembimbing_asal')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard-pembimbing-asal');
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
        if (Auth::guard('pembimbing_asal')->check()) {
            Auth::guard('pembimbing_asal')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // 🔹 Ambil data profil admin yang sedang login (untuk isi popup)
    // Catatan: password TIDAK dikirim karena tersimpan dalam bentuk hash
    // (satu arah), jadi password asli memang tidak bisa ditampilkan lagi.
    public function getProfile()
    {
        $admin = Auth::guard('admin')->user();

        return response()->json([
            'username' => $admin->username,
        ]);
    }

    // 🔹 Update username & (opsional) password admin yang sedang login
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'username' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique($admin->getTable(), 'username')
                    ->ignore($admin->getKey(), $admin->getKeyName()),
            ],
            'password' => 'nullable|min:5',
        ], [
            'username.unique' => 'Username ini sudah dipakai.',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        $data = [];

        if ($request->filled('username')) {
            $data['username'] = $request->username;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if (empty($data)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada perubahan yang disimpan. Isi username dan/atau password terlebih dahulu.',
                ], 422);
            }

            return back()->with('error', 'Tidak ada perubahan yang disimpan.');
        }

        $admin->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profil admin berhasil diperbarui.',
                'data' => [
                    'username' => $admin->username,
                ],
            ]);
        }

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }
}
