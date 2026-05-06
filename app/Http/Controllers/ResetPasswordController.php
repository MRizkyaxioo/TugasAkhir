<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Peserta;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
{
    return view('auth.reset_password', compact('token'));
}

public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|confirmed'
    ]);

    $data = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$data) {
        return back()->with('error', 'Token tidak valid');
    }

    if (Carbon::parse($data->created_at)->addMinutes(60)->isPast()) {
        return back()->with('error', 'Token sudah kadaluarsa');
    }

    Peserta::where('email', $request->email)
        ->update([
            'password' => Hash::make($request->password)
        ]);

    DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->delete();

    return redirect()->route('peserta.login')
        ->with('success', 'Password berhasil diubah');
}
}
