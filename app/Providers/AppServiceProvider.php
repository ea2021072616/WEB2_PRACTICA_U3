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

            // Obtener el host - verificar que no esté vacío
            $host = null;

            // Intentar HTTP_X_FORWARDED_HOST primero
            if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
            }
            // Luego HTTP_HOST
            elseif (!empty($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            }
            // Finalmente, extraer del APP_URL configurado
            else {
                $appUrl = env('APP_URL', config('app.url'));
                $host = parse_url($appUrl, PHP_URL_HOST);
            }

            // Si aún no tenemos host, usar el de Render directamente
            if (empty($host)) {
                $host = 'web2-practica-u3.onrender.com';
            }

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
