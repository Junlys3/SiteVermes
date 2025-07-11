<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services teste.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
            // Fallback para arquivos da pasta storage
        Route::get('/storage/{path}', function ($path) {
            $file = storage_path('app/public/' . $path);
            if (!file_exists($file)) {
                abort(404);
            }
            return Response::file($file);
        })->where('path', '.*');
    }
}
