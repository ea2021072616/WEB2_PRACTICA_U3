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
        
        if ($isHttps) {
            URL::forceScheme('https');
        }

        // Forzar la URL raíz en producción para evitar URLs malformadas
        if (app()->environment('production')) {
            $appUrl = config('app.url');
            
            // Asegurarse de que APP_URL tenga el formato correcto
            if ($appUrl && !str_starts_with($appUrl, 'http://') && !str_starts_with($appUrl, 'https://')) {
                // Si falta el protocolo completo, agregarlo
                $appUrl = 'https://' . ltrim($appUrl, 'https:/http:/');
                config(['app.url' => $appUrl]);
            }
            
            if ($appUrl) {
                URL::forceRootUrl($appUrl);
            }
        }
    }
}
