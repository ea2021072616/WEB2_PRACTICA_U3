#!/bin/bash
set -e

echo "🚀 Starting Laravel application initialization..."

# Crear directorios de logs si no existen
mkdir -p /var/log/supervisor
mkdir -p /var/log/nginx

# Esperar a que la base de datos esté lista (opcional)
wait_for_db() {
    host="$1"
    port="${2:-3306}"
    max_retries=24  # 24 * 5s = 120s por defecto
    retry=0

    echo "⏳ Waiting for database to be ready at $host:$port..."

    if command -v nc >/dev/null 2>&1; then
        # Usar nc si está disponible
        while ! nc -z -v -w5 "$host" "$port" >/dev/null 2>&1; do
            retry=$((retry+1))
            echo "Waiting for database connection... ($retry/$max_retries)"
            if [ "$retry" -ge "$max_retries" ]; then
                echo "❌ Database did not become ready in time" >&2
                return 1
            fi
            sleep 5
        done
    else
        # Fallback a bash /dev/tcp (requiere bash)
        while ! (echo > /dev/tcp/"$host"/"$port") >/dev/null 2>&1; do
            retry=$((retry+1))
            echo "Waiting for database connection... ($retry/$max_retries)"
            if [ "$retry" -ge "$max_retries" ]; then
                echo "❌ Database did not become ready in time" >&2
                return 1
            fi
            sleep 5
        done
    fi

    echo "✅ Database is ready!"
    return 0
}

if [ ! -z "$DB_HOST" ]; then
    if ! wait_for_db "$DB_HOST" "${DB_PORT:-3306}"; then
        echo "Database check failed, exiting." >&2
        exit 1
    fi
fi

# Configurar permisos correctos para storage y cache
echo "📁 Setting up permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Limpiar cache de Laravel
echo "🧹 Clearing Laravel cache..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

# Optimizar para producción
if [ "$APP_ENV" = "production" ]; then
    echo "⚡ Optimizing for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Ejecutar migraciones si está habilitado
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "🗄️ Running database migrations..."
    php artisan migrate --force
fi

# Ejecutar seeders si está habilitado
if [ "$RUN_SEEDERS" = "true" ]; then
    echo "🌱 Running database seeders..."
    php artisan db:seed --force
fi

# Generar clave de aplicación si no existe
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Crear enlace simbólico de storage
echo "🔗 Creating storage link..."
php artisan storage:link || true

echo "✅ Laravel initialization completed!"
echo "🌐 Starting web services..."

# Ejecutar el comando pasado como argumento (supervisord)
exec "$@"
