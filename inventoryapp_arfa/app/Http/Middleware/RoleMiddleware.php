<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (empty($user->role)) {
            abort(403, 'Role pengguna tidak ditemukan');
        }

        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Akses ditolak. Kamu tidak memiliki hak akses.',
                ], 403);
            }

            abort(403, 'AKSES DITOLAK - Role tidak diizinkan');
        }

        return $next($request);
    }
}