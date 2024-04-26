<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MultiroleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Mengecek apakah pengguna terotentikasi
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
        foreach ($roles as $role) {
            if (auth()->user()->role->name === $role) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
