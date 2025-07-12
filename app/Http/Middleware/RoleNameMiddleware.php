<?php

namespace App\Http\Middleware;

use App\Services\RedirectWithNotification;
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
        $user = auth()->user();

        if (!$user || !$user->role || !in_array(strtolower($user->role->role_name), $roles)) {
            return RedirectWithNotification::back(
                false,
                '',
                'Anda tidak memiliki izin untuk mengakses halaman ini.'
            );
        }

        return $next($request);
    }
}
