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
        $this->app->bind(
            \App\Repositories\Interfaces\DataBerkasRepositoryInterface::class,
            \App\Repositories\DataBerkasRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\StafDetailRepositoryInterface::class,
            \App\Repositories\StafDetailRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\NotarisDetailRepositoryInterface::class,
            \App\Repositories\NotarisDetailRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\DataJadwalRepositoryInterface::class,
            \App\Repositories\DataJadwalRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\KategoriPihakRepositoryInterface::class,
            \App\Repositories\KategoriPihakRepository::class
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
