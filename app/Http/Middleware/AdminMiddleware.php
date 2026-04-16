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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (!Auth::guard('admin')->check() && !Auth::guard('pembimbing')->check()) {
        return redirect()->route('admin.login')
            ->with('error', 'Anda harus login terlebih dahulu');
    }

    // 🔒 proteksi admin
    if ($request->is('dashboard-admin') && !Auth::guard('admin')->check()) {
        abort(403, 'Akses ditolak');
    }

    // 🔒 proteksi pembimbing
    if ($request->is('dashboard-pembimbing') && !Auth::guard('pembimbing')->check()) {
        abort(403, 'Akses ditolak');
    }

    return $next($request);
}
}
