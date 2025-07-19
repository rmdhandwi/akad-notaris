<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        $interfacePath = app_path('Repositories/Interfaces');

        foreach (File::allFiles($interfacePath) as $file) {
            $interfaceName = $file->getFilenameWithoutExtension(); // Misalnya: DataBerkasRepositoryInterface
            $interfaceClass = "App\\Repositories\\Interfaces\\{$interfaceName}";
            $repositoryClass = "App\\Repositories\\" . str_replace('Interface', '', $interfaceName);

            if (interface_exists($interfaceClass) && class_exists($repositoryClass)) {
                $this->app->bind($interfaceClass, $repositoryClass);
            }
        }
        // manual
        // $this->app->bind(
        //     \App\Repositories\Interfaces\NamaRepositoryInterface::class,
        //     \App\Repositories\NamaRepository::class
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
