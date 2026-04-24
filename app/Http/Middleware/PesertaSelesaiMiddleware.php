<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaSelesaiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('peserta')->check()) {
            return redirect('/login-peserta')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $peserta = Auth::guard('peserta')->user();
        $status = $peserta->hasilPendaftaran->status ?? 'pending';

        // ❌ kalau belum selesai, jangan masuk
        if ($status !== 'selesai') {
            if ($status === 'diterima') {
                return redirect('/dashboard-peserta');
            }

            return redirect('/dashboard-calon');
        }

        return $next($request);
    }
}
