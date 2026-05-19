<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek apakah login salah satu guard
        if (
            !Auth::guard('admin')->check() &&
            !Auth::guard('pembimbing')->check() &&
            !Auth::guard('pembimbing_asal')->check()
        ) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Anda harus login terlebih dahulu');
        }

        // 🔒 proteksi dashboard admin
        if (
            $request->is('dashboard-admin') &&
            !Auth::guard('admin')->check()
        ) {
            abort(403, 'Akses ditolak');
        }

        // 🔒 proteksi dashboard pembimbing lapangan
        if (
            $request->is('dashboard-pembimbing') &&
            !Auth::guard('pembimbing')->check()
        ) {
            abort(403, 'Akses ditolak');
        }

        // 🔒 proteksi dashboard pembimbing asal
        if (
            $request->is('dashboard-pembimbing-asal') &&
            !Auth::guard('pembimbing_asal')->check()
        ) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
