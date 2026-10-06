<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah user sudah login dan rolenya adalah 'super_admin' atau 'staff'
        if (!auth()->check() || !in_array(auth()->user()->role, ['super_admin', 'staff'])) {
            abort(403, 'Akses hanya untuk Super Admin dan Staff.');
        }

        return $next($request);
    }
}