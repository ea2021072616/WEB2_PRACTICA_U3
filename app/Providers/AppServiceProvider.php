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
        // Para Render y otros servicios de hosting con proxy reverso
        if ($this->isRunningBehindProxy()) {
            URL::forceScheme('https');
            
            // Construir la URL correcta basada en el host del request
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'] 
                ?? $_SERVER['HTTP_HOST'] 
                ?? parse_url(config('app.url'), PHP_URL_HOST) 
                ?? 'localhost';
            
            // Limpiar el host de cualquier cosa extra
            $host = preg_replace('/[^a-zA-Z0-9\.\-]/', '', $host);
            
            $rootUrl = 'https://' . $host;
            URL::forceRootUrl($rootUrl);
            config(['app.url' => $rootUrl]);
        }
    }
    
    /**
     * Detectar si estamos detrás de un proxy (Render, Cloudflare, etc.)
     */
    private function isRunningBehindProxy(): bool
    {
        $forwardedProto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? null;
        
        return $forwardedProto === 'https' 
            || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            || app()->environment('production');
    }
}
