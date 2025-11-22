# 🚀 Guía de Despliegue en Render - Sistema de Atenciones

Esta documentación detalla todos los pasos y configuraciones necesarias para desplegar exitosamente tu aplicación Laravel en Render usando Docker.

---

## 📋 Tabla de Contenidos

1. [Archivos Creados para el Despliegue](#archivos-creados)
2. [Arquitectura Docker](#arquitectura-docker)
3. [Configuración de Render](#configuración-de-render)
4. [Variables de Entorno](#variables-de-entorno)
5. [Proceso de Despliegue](#proceso-de-despliegue)
6. [Verificación Post-Despliegue](#verificación)
7. [Solución de Problemas](#problemas-comunes)

---

## 📁 Archivos Creados para el Despliegue

### ✅ Archivos Nuevos

```
✅ Dockerfile                          # Configuración Docker multi-etapa
✅ .dockerignore                       # Optimización de contexto Docker
✅ docker/nginx/nginx.conf            # Configuración del servidor web
✅ docker/supervisord.conf            # Gestión de procesos
✅ docker/docker-entrypoint.sh        # Script de inicialización
✅ DEPLOYMENT.md                       # Esta documentación
```

### 🔧 Archivos Modificados

```
🔄 app/Providers/AppServiceProvider.php   # Soporte HTTPS + Proxies
🔄 vite.config.js                         # Integración TailwindCSS
🔄 .env.example                           # Variables para Render
```

---

## 🐳 Arquitectura Docker

### Dockerfile Multi-Etapa

El `Dockerfile` utiliza una arquitectura de 3 etapas optimizada:

#### **Etapa 1: Composer Dependencies**
```dockerfile
FROM composer:2.7 AS composer-builder
```
- Instala dependencias PHP de producción
- Optimiza el autoloader
- Excluye dependencias de desarrollo

#### **Etapa 2: Node Build (Frontend Assets)**
```dockerfile
FROM node:20-bullseye AS node-builder
```
- Instala dependencias de Node.js
- Compila assets con Vite + TailwindCSS
- Genera archivos optimizados en `public/build/`

#### **Etapa 3: Runtime (PHP-FPM + Nginx + Supervisor)**
```dockerfile
FROM php:8.2-fpm-bullseye
```
- Imagen base ligera con PHP-FPM
- Instala extensiones PHP necesarias (PDO, MySQL, GD, etc.)
- Configura Nginx como servidor web
- Supervisor gestiona los procesos

### Servicios Configurados

1. **PHP-FPM**: Procesa código PHP Laravel
2. **Nginx**: Servidor web optimizado para Laravel
3. **Supervisor**: Gestiona y mantiene servicios activos

---

## ⚙️ Configuración de Render

### 1. Crear Servicio Web

1. Ve a [Render Dashboard](https://dashboard.render.com)
2. Click en "New +" → "Web Service"
3. Conecta tu repositorio de GitHub
4. Configura el servicio:

```yaml
Name: sistema-atenciones-u3
Environment: Docker
Region: Oregon (US West) o la más cercana
Branch: main
```

### 2. Configuración del Servicio

```yaml
# En el dashboard de Render:
Docker Command: (dejar vacío, usa el CMD del Dockerfile)
Port: 8080
Health Check Path: /
```

### 3. Plan de Servicio

- **Free**: Para pruebas (se apaga después de 15 minutos de inactividad)
- **Starter ($7/mes)**: Recomendado para producción

---

## 🔐 Variables de Entorno

### Variables Requeridas en Render

Configura estas variables en: **Dashboard → Environment → Environment Variables**

#### **Básicas (Obligatorias)**

```bash
APP_NAME="Sistema de Atenciones"
APP_ENV=production
APP_KEY=base64:TU_CLAVE_GENERADA_AQUI
APP_DEBUG=false
APP_URL=https://tu-app.onrender.com
```

#### **Base de Datos**

Opción 1: Base de datos de Render (recomendado)
```bash
DB_CONNECTION=mysql
DB_HOST=tu-db-host.onrender.com
DB_PORT=3306
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña_segura
```

Opción 2: Base de datos externa
```bash
DB_CONNECTION=mysql
DB_HOST=tu-host-externo
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

#### **Seguridad**

```bash
SESSION_SECURE_COOKIE=true
SESSION_DRIVER=database
LOG_LEVEL=error
```

#### **Opcionales pero Recomendadas**

```bash
# Ejecutar migraciones automáticamente en cada deploy
RUN_MIGRATIONS=true

# Ejecutar seeders (solo la primera vez)
RUN_SEEDERS=false

# Sanctum (si usas autenticación API)
SANCTUM_STATEFUL_DOMAINS=tu-app.onrender.com
```

### Generar APP_KEY

**Localmente:**
```powershell
php artisan key:generate --show
```

Copia el valor que empieza con `base64:` y agrégalo como variable de entorno en Render.

---

## 🚀 Proceso de Despliegue

### Paso 1: Preparar el Repositorio

```powershell
# Verifica que todos los archivos estén en el repositorio
git status

# Agrega los archivos nuevos
git add Dockerfile .dockerignore docker/ DEPLOYMENT.md

# Agrega archivos modificados
git add app/Providers/AppServiceProvider.php vite.config.js .env.example

# Commit
git commit -m "Configure Docker deployment for Render"

# Push al repositorio
git push origin main
```

### Paso 2: Crear Base de Datos en Render

1. En Render Dashboard: "New +" → "PostgreSQL" o "MySQL"
2. Nombre: `sistema-atenciones-db`
3. Plan: Free (para pruebas) o Starter
4. Copia las credenciales generadas

### Paso 3: Configurar el Servicio Web

1. Crea el Web Service como se explicó anteriormente
2. Agrega todas las variables de entorno
3. Conecta con la base de datos
4. Click en "Create Web Service"

### Paso 4: Monitoreo del Build

Render automáticamente:
1. ✅ Clonará tu repositorio
2. ✅ Construirá la imagen Docker (3 etapas)
3. ✅ Instalará dependencias PHP y Node.js
4. ✅ Compilará assets con Vite
5. ✅ Iniciará los servicios

**Tiempo estimado:** 5-10 minutos

### Paso 5: Primera Inicialización

Una vez desplegado, verifica los logs para confirmar:

```
✅ Laravel initialization completed!
✅ Database is ready!
✅ Starting web services...
```

---

## ✅ Verificación Post-Despliegue

### Checklist de Verificación

1. **Acceso HTTPS**: `https://tu-app.onrender.com`
   - ✅ Certificado SSL automático
   - ✅ Redirección HTTP → HTTPS

2. **Assets Cargando**:
   - ✅ Estilos CSS funcionando
   - ✅ JavaScript cargando
   - ✅ No hay errores en la consola del navegador

3. **Base de Datos**:
   - ✅ Conexión exitosa
   - ✅ Migraciones ejecutadas
   - ✅ Tablas creadas

4. **Autenticación**:
   - ✅ Login funcionando
   - ✅ Sesiones persistentes
   - ✅ Cookies seguras

### Comandos de Verificación

En el **Shell de Render** (Dashboard → Shell):

```bash
# Verificar conexión a la base de datos
php artisan migrate:status

# Listar rutas
php artisan route:list

# Verificar configuración
php artisan config:show app
php artisan config:show database

# Ver logs
tail -f storage/logs/laravel.log
```

---

## 🐛 Problemas Comunes

### 1. Error 500 - Internal Server Error

**Causa:** `APP_KEY` no configurada

**Solución:**
```powershell
# Local
php artisan key:generate --show

# Copia el resultado y agrégalo en Render como variable APP_KEY
```

### 2. Assets no cargan (404 en /build/assets/*)

**Causa:** Vite no compiló correctamente

**Solución:**
- Verifica que `package-lock.json` esté en el repo
- Revisa los logs del build en Render
- Confirma que `vite.config.js` tenga el plugin de TailwindCSS

### 3. Error de conexión a base de datos

**Causa:** Variables de entorno incorrectas

**Solución:**
```bash
# Verifica las credenciales en Render Dashboard
# Asegúrate de que DB_HOST, DB_DATABASE, etc. sean correctos
```

### 4. Nginx: user "nginx" failed

**Causa:** Usuario incorrecto en nginx.conf

**Solución:** Ya está corregido en `docker/nginx/nginx.conf`
```nginx
user www-data;  # Correcto para php:fpm-bullseye
```

### 5. Permisos de storage/logs

**Causa:** Permisos incorrectos

**Solución:** El `docker-entrypoint.sh` ya configura esto automáticamente:
```bash
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
```

---

## 📊 Estructura de Archivos Docker

```
WEB2_PRACTICA_U3/
├── Dockerfile                     # Configuración Docker multi-etapa
├── .dockerignore                  # Archivos excluidos del build
├── docker/
│   ├── nginx/
│   │   └── nginx.conf            # Configuración Nginx optimizada
│   ├── supervisord.conf          # Gestión de procesos
│   └── docker-entrypoint.sh      # Script de inicialización
└── DEPLOYMENT.md                  # Esta documentación
```

---

## 🔧 Configuraciones Clave

### AppServiceProvider.php

```php
// Forzar HTTPS en producción
if (config('app.env') === 'production') {
    URL::forceScheme('https');
}

// Confiar en proxies de Render
Request::setTrustedProxies(['*'], 
    Request::HEADER_X_FORWARDED_FOR |
    Request::HEADER_X_FORWARDED_HOST |
    Request::HEADER_X_FORWARDED_PORT |
    Request::HEADER_X_FORWARDED_PROTO
);
```

### Nginx Headers de Seguridad

```nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
```

### Vite + TailwindCSS

```javascript
import tailwindcss from '@tailwindcss/vite';

plugins: [
    laravel({...}),
    tailwindcss(),
]
```

---

## 🎯 Resultado Esperado

Una vez completado el despliegue:

- ✅ **URL activa**: `https://tu-app.onrender.com`
- ✅ **SSL automático**: Certificado válido
- ✅ **Assets optimizados**: CSS/JS comprimidos
- ✅ **Base de datos**: Conectada y funcionando
- ✅ **Servicios activos**: PHP-FPM + Nginx
- ✅ **Logs disponibles**: En Dashboard de Render

---

## 📝 Comandos Útiles

### Para el Repositorio

```powershell
# Ver archivos modificados
git status

# Agregar todos los cambios
git add .

# Commit con mensaje descriptivo
git commit -m "Update deployment configuration"

# Push para desplegar
git push origin main
```

### En el Shell de Render

```bash
# Ejecutar migraciones manualmente
php artisan migrate --force

# Limpiar cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🌐 Recursos Adicionales

- [Documentación de Render](https://render.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/)

---

## 🆘 Soporte

Si encuentras problemas:

1. Revisa los logs en Render Dashboard
2. Verifica las variables de entorno
3. Consulta esta documentación
4. Revisa la [documentación de Laravel](https://laravel.com/docs)

---

**✨ ¡Felicidades! Tu aplicación Laravel está lista para producción en Render.**

*Última actualización: Noviembre 2025*
