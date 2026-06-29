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
    $data = DB::table('password_reset_tokens')
        ->where('token', $token)
        ->first();

    // token sudah pernah dipakai
    if (!$data) {
        return redirect()
            ->route('peserta.login')
            ->with('error', 'Link reset password sudah tidak berlaku atau telah digunakan.');
    }

    // token sudah kadaluarsa
    if (Carbon::parse($data->created_at)->addMinutes(60)->isPast()) {

        DB::table('password_reset_tokens')
            ->where('token', $token)
            ->delete();

        return redirect()
            ->route('peserta.login')
            ->with('error', 'Link reset password telah kadaluarsa.');
    }

    return view('auth.reset_password', [
        'token' => $token,
        'email' => $data->email,
    ]);
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
    return redirect()
        ->route('peserta.login')
        ->with('error', 'Link reset password sudah tidak berlaku atau telah digunakan.');
    }

    if (Carbon::parse($data->created_at)->addMinutes(60)->isPast()) {

    DB::table('password_reset_tokens')
        ->where('token', $request->token)
        ->delete();

    return redirect()
        ->route('peserta.login')
        ->with('error', 'Link reset password telah kadaluarsa.');
}

    Peserta::where('email', $request->email)
        ->update([
            'password' => Hash::make($request->password)
        ]);

    DB::table('password_reset_tokens')
        ->where('token', $request->token)
        ->delete();

    return redirect()->route('peserta.login')
        ->with('success', 'Password berhasil diubah');
}
}
