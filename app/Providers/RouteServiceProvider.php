<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleNameMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Daftarkan alias middleware
        Route::aliasMiddleware('roleName', RoleNameMiddleware::class);
    }
}
