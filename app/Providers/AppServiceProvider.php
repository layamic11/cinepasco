<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CarritoInterface;
use App\Services\CarritoSingleton;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // REGISTRAMOS EL VÍNCULO PARA LA INVERSIÓN DE DEPENDENCIAS
        $this->app->singleton(CarritoInterface::class, function ($app) {
            return new CarritoSingleton();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}