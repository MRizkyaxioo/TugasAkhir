<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CalonPesertaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('peserta')->check()) {
            return redirect('/login-peserta')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $peserta = Auth::guard('peserta')->user();
        $status = $peserta->hasilPendaftaran->status ?? 'pending';

        // kalau sudah diterima, jangan ke dashboard calon
        if ($status === 'diterima') {
            return redirect('/dashboard-peserta');
        }

        return $next($request);
    }
}
