<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Peserta;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForm()
{
    return view('auth.lupa_password');
}

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $peserta = Peserta::where('email', $request->email)->first();

    if (!$peserta) {
        return back()->with('error', 'Email Anda belum terdaftar');
    }

    $token = Str::random(64);

    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => $token,
            'created_at' => Carbon::now()
        ]
    );

    $link = url('/reset-password/'.$token);

    Mail::raw("Klik link untuk reset password: $link", function ($msg) use ($request) {
        $msg->to($request->email)
            ->subject('Reset Password');
    });

    return back()->with(
    'success',
    'Link reset password berhasil dikirim. Silakan cek email Anda.'
);
}
}
