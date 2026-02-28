<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUser = Auth::user();
        $userRole = $authUser->role; // Sesuaikan dengan kolom 'role' di migrasi kita

        // Cek juga keaktifan user (mutasi)
        if (!$authUser->is_aktif) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda sudah tidak aktif (Mutasi).');
        }

        // Jika role user tidak sesuai dengan yang diminta oleh Route
        if ($userRole !== $role) {
            return match ($userRole) {
                'superadmin'  => redirect()->route('admin.dashboard'),
                'kabag_hukum' => redirect()->route('kabag.dashboard'),
                'operator'    => redirect()->route('operator.dashboard'),
                default       => redirect('/'),
            };
        }

        return $next($request);
    }
}
