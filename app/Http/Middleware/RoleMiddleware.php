<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
{
    if (!Auth::check()) {
        abort(403, 'Akses ditolak. Anda belum login.');
    }

    $user = Auth::user();

    if ($user->role !== $role) {
        // Redirect ke dashboard sesuai role mereka
        if ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika role tidak dikenali
        abort(403, 'Akses ditolak. Role tidak dikenali.');
    }

    return $next($request);
}
}
