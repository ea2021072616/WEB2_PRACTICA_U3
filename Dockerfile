# ==========================================
# Stage 1: Composer Dependencies
# ==========================================
FROM composer:2.7 AS composer-builder

WORKDIR /app

# Copiar archivos de dependencias
COPY composer.json composer.lock ./

# Instalar dependencias de producción optimizadas
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Copiar código fuente
COPY . .

# Optimizar autoloader con código completo
RUN composer dump-autoload --optimize --no-dev

# ==========================================
# Stage 2: Node Build (Frontend Assets)
# ==========================================
FROM node:20-bullseye AS node-builder

WORKDIR /app

# Copiar archivos de dependencias Node.js
COPY package.json package-lock.json ./

# Instalar dependencias
RUN npm ci --prefer-offline --no-audit --progress=false

# Copiar archivos de configuración necesarios para el build
COPY vite.config.js tailwind.config.js postcss.config.js ./

# Copiar archivos fuente de recursos
COPY resources/ ./resources/

# Copiar el resto del código (esto incluye vendor y otros archivos)
COPY . .

# Copiar vendor desde composer (necesario para Laravel Mix/Vite)
COPY --from=composer-builder /app/vendor ./vendor

# Crear directorio public para Vite y verificar estructura
RUN mkdir -p public/build

# Debug: Verificar archivos antes del build
RUN echo "=== Files before build ===" && \
    ls -la && \
    echo "=== Package.json contents ===" && \
    cat package.json

# Compilar assets con Vite
RUN npm run build

# Debug: Verificar archivos después del build
RUN echo "=== Files after build ===" && \
    ls -la public/build/ && \
    echo "=== Manifest contents ===" && \
    cat public/build/manifest.json || echo "Manifest not found"

# ==========================================
# Stage 3: Runtime (PHP-FPM + Nginx + Supervisor)
# ==========================================
FROM php:8.2-fpm-bullseye

# Variables de entorno
ENV DEBIAN_FRONTEND=noninteractive \
    PHP_MEMORY_LIMIT=256M \
    PHP_UPLOAD_MAX_FILESIZE=50M \
    PHP_POST_MAX_SIZE=50M

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Configurar PHP
RUN echo "memory_limit = ${PHP_MEMORY_LIMIT}" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "upload_max_filesize = ${PHP_UPLOAD_MAX_FILESIZE}" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = ${PHP_POST_MAX_SIZE}" >> /usr/local/etc/php/conf.d/uploads.ini

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar código de la aplicación desde composer stage
COPY --from=composer-builder /app /var/www/html

# Copiar assets compilados desde node stage (ubicación correcta)
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Verificar que los assets se copiaron correctamente
RUN echo "=== Verifying assets copy ===" && \
    ls -la /var/www/html/public/build/ && \
    echo "=== Checking manifest ===" && \
    test -f /var/www/html/public/build/manifest.json && \
    echo "✅ Manifest file exists" || \
    echo "❌ Manifest file missing"

# Copiar configuraciones de servicios
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Hacer ejecutable el entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Crear directorios necesarios y establecer permisos
RUN mkdir -p \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache \
    /var/log/nginx \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/log/nginx \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Exponer puerto (Render usa la variable PORT)
EXPOSE 8080

# Usar entrypoint personalizado
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Iniciar Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
