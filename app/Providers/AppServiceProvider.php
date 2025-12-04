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
        // Para Render y otros servicios de hosting, detectar HTTPS del proxy
        $forwardedProto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? null;
        $isHttps = $forwardedProto === 'https' 
            || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
        
        // Solo forzar scheme, NO forzar root URL (dejar que Laravel lo detecte)
        if ($isHttps) {
            URL::forceScheme('https');
        }
    }
}
