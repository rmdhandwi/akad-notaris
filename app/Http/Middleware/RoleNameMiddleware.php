<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // $user = auth()->user();
        $user = auth()->guard()->user();

        if (!$user || !$user->roles || !in_array(strtolower($user->roles->name), $roles)) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
