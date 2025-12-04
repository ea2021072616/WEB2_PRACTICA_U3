<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        // Forzar HTTPS en producción (para Render y otros servicios con proxy/load balancer)
        // Detectamos por múltiples métodos para mayor compatibilidad
        if ($this->isProduction() || $this->isBehindHttpsProxy()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Detecta si estamos en producción
     */
    private function isProduction(): bool
    {
        return config('app.env') === 'production' 
            || env('APP_ENV') === 'production'
            || !empty(env('RENDER'));  // Variable de Render
    }

    /**
     * Detecta si estamos detrás de un proxy HTTPS (Render, Heroku, etc.)
     */
    private function isBehindHttpsProxy(): bool
    {
        return (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
            || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            || (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on');
    }
}
