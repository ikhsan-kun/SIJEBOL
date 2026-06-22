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
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if (in_array(trim(strtolower($user->role ?? '')), ['admin', 'admin pusat', 'cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])) {
                return $next($request);
            }
            
            // Jika user biasa nyasar ke area admin
            return redirect()->route('masyarakat.dashboard')->with('error', 'Akses ditolak.');
        }

        // Jika belum login sama sekali
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }
}
