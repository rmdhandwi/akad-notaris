<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind each repository and its interface
        $this->app->bind(
            \App\Repositories\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\KategoriLayananRepositoryInterface::class,
            \App\Repositories\KategoriLayananRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\JenisLayananRepositoryInterface::class,
            \App\Repositories\JenisLayananRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
