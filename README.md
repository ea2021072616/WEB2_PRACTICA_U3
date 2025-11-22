# 🎓 Sistema de Consejería UPT

Sistema web para el registro y gestión de atenciones de consejería y tutoría a estudiantes de la Universidad Privada de Tacna.

## 🚀 Inicio Rápido - LEER PRIMERO

**Para probar el sistema inmediatamente:**

1. Abrir terminal en la carpeta del proyecto
2. Ejecutar: `php artisan serve`
3. Abrir navegador en: http://localhost:8000
4. Usar una de estas credenciales:

### 👨‍💼 ADMINISTRADOR (acceso completo)
```
Email: admin@upt.pe
Password: admin123
```

### 👨‍🏫 DOCENTE (registrar atenciones)
```
Email: docente1@upt.pe
Password: docente123
```
(También disponibles: docente2@upt.pe, docente3@upt.pe, docente4@upt.pe, docente5@upt.pe - mismo password)

### 👨‍🎓 ESTUDIANTE (ver sus asesorías)
```
Email: estudiante1@virtual.upt.pe
Password: estudiante123
```
(También disponibles: estudiante2@virtual.upt.pe hasta estudiante15@virtual.upt.pe - mismo password)

## 💻 Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL
- Node.js y NPM

---

## ⚙️ Instalación Completa (Solo si es necesario)

**NOTA:** Si la base de datos ya está configurada, solo ejecutar `php artisan serve`

### 1. Instalar dependencias de PHP:
```bash
composer install
```

### 2. Instalar dependencias de Node.js:
```bash
npm install
```

### 3. Configurar el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=45.55.215.51
DB_PORT=3306
DB_DATABASE=erick
DB_USERNAME=erick
DB_PASSWORD=123
```

### 4. Ejecutar migraciones y seeders:
```bash
php artisan migrate:fresh --seed
```
**Esto creará:**
- ✅ 1 Administrador
- ✅ 5 Docentes
- ✅ 15 Estudiantes
- ✅ 5 Temas de consejería
- ✅ Múltiples atenciones de ejemplo

### 5. Crear enlace simbólico para storage:
```bash
php artisan storage:link
```

### 6. Compilar assets (opcional):
```bash
npm run build
```

---

## 🚀 Ejecutar el Proyecto

### Modo desarrollo (recomendado):
```bash
php artisan serve
```
Acceder a: **http://localhost:8000**

### Con hot-reload (desarrollo avanzado):
**Terminal 1:**
```bash
php artisan serve
```
**Terminal 2:**
```bash
npm run dev
```

---

## 📁 Estructura del Proyecto

```
sistema_consejeria_upt/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminDashboardController.php       # Dashboard admin
│   │   │   ├── DocenteDashboardController.php     # Dashboard docente
│   │   │   ├── EstudianteDashboardController.php  # Dashboard estudiante
│   │   │   ├── AtencionController.php             # CRUD atenciones
│   │   │   ├── DocenteController.php              # CRUD docentes
│   │   │   ├── EstudianteController.php           # CRUD estudiantes
│   │   │   └── TemaController.php                 # CRUD temas
│   │   └── Middleware/
│   │       ├── ValidateUptEmail.php               # Validar email UPT
│   │       └── CheckRole.php                      # Verificar roles
│   └── Models/
│       ├── User.php           # Usuario + métodos de roles
│       ├── Atencion.php       # Atención de consejería
│       ├── Docente.php        # Docente
│       ├── Estudiante.php     # Estudiante
│       └── Tema.php           # Tema de consejería
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_estudiantes_table.php
│   │   ├── create_docentes_table.php
│   │   ├── create_temas_table.php
│   │   ├── create_atenciones_table.php
│   │   └── add_role_to_users_table.php            # Columna de roles
│   └── seeders/
│       ├── TemaSeeder.php                         # 5 temas predefinidos
│       ├── AdminUserSeeder.php                    # Usuario admin
│       ├── DocenteSeeder.php                      # 5 docentes
│       ├── EstudianteSeeder.php                   # 15 estudiantes
│       └── AtencionSeeder.php                     # Atenciones de ejemplo
│
├── resources/
│   └── views/
│       ├── dashboards/
│       │   ├── admin.blade.php          # Dashboard administrador
│       │   ├── docente.blade.php        # Dashboard docente
│       │   ├── estudiante.blade.php     # Dashboard estudiante
│       │   └── reportes.blade.php       # Reportes admin
│       ├── atenciones/                  # CRUD completo atenciones
│       ├── docentes/                    # CRUD completo docentes
│       ├── estudiantes/                 # CRUD completo estudiantes
│       └── temas/                       # CRUD completo temas
│
└── routes/
    └── web.php                          # Rutas con protección por roles
```

---

## 🎯 Sistema de Roles - Cómo Funciona

El sistema tiene **3 tipos de usuarios diferentes**, cada uno con su propia vista y permisos:

### 🔴 ROL: ADMINISTRADOR
**¿Quién es?** El coordinador o jefe del sistema de consejería

**¿Qué puede hacer?**
- ✅ Ver estadísticas completas del sistema
- ✅ Gestionar estudiantes (crear, editar, eliminar)
- ✅ Gestionar docentes (crear, editar, eliminar)
- ✅ Gestionar temas de consejería
- ✅ Ver TODAS las atenciones del sistema
- ✅ Generar reportes con filtros avanzados
- ✅ Acceso total a todas las funciones

**Credenciales:**
- Email: `admin@upt.pe`
- Password: `admin123`

---

### 🟢 ROL: DOCENTE
**¿Quién es?** Profesores que brindan consejería a estudiantes

**¿Qué puede hacer?**
- ✅ Ver sus propias estadísticas
- ✅ Registrar nuevas atenciones a estudiantes
- ✅ Ver solo SUS atenciones (no las de otros docentes)
- ✅ Editar sus propias atenciones
- ✅ Ver cuántos estudiantes ha atendido
- ❌ NO puede ver atenciones de otros docentes
- ❌ NO puede eliminar registros
- ❌ NO puede gestionar usuarios ni temas

**Credenciales disponibles:**
- `docente1@upt.pe` / `docente123` (Dra. María González)
- `docente2@upt.pe` / `docente123` (Dr. José Ramírez)
- `docente3@upt.pe` / `docente123` (Mg. Ana Torres)
- `docente4@upt.pe` / `docente123` (Dr. Luis Fernández)
- `docente5@upt.pe` / `docente123` (Mg. Carmen Salazar)

---

### 🔵 ROL: ESTUDIANTE
**¿Quién es?** Alumnos de la universidad

**¿Qué puede hacer?**
- ✅ Ver su información personal y código de estudiante
- ✅ Ver solo SUS asesorías recibidas
- ✅ Ver estadísticas de sus consultas por tema
- ✅ Ver qué docentes lo han atendido
- ❌ NO puede crear atenciones
- ❌ NO puede ver asesorías de otros estudiantes
- ❌ NO puede editar ni eliminar

**Credenciales disponibles (15 estudiantes):**
- `estudiante1@virtual.upt.pe` / `estudiante123` (Juan Carlos Mamani - 2020057001)
- `estudiante2@virtual.upt.pe` / `estudiante123` (María Fernanda Flores - 2020057002)
- `estudiante3@virtual.upt.pe` / `estudiante123` (Pedro Antonio Gutiérrez - 2021058003)
- ... hasta `estudiante15@virtual.upt.pe`

---

## 📱 Flujo de Uso del Sistema

### 1️⃣ COMO ADMINISTRADOR:
```
1. Login con admin@upt.pe / admin123
2. Ver dashboard con todas las estadísticas
3. Gestionar estudiantes, docentes, temas
4. Ver todas las atenciones
5. Generar reportes filtrados
```

### 2️⃣ COMO DOCENTE:
```
1. Login con docente1@upt.pe / docente123
2. Ver tu dashboard personal
3. Click en "Registrar Nueva Atención"
4. Seleccionar estudiante, tema, fecha
5. Escribir consulta y descripción
6. Subir evidencia (opcional)
7. Ver tus atenciones registradas
```

### 3️⃣ COMO ESTUDIANTE:
```
1. Login con estudiante1@virtual.upt.pe / estudiante123
2. Ver tu dashboard con tus estadísticas
3. Ver todas tus asesorías recibidas
4. Ver qué temas has consultado más
5. Ver detalles de cada asesoría
```

---

## 🔐 Seguridad Implementada

- ✅ **Login corporativo UPT**: Solo emails `@upt.pe` o `@virtual.upt.pe`
- ✅ **Roles separados**: Cada usuario ve solo lo que le corresponde
- ✅ **Middleware de roles**: Las rutas están protegidas
- ✅ **Filtrado automático**: Los datos se filtran según el rol
- ✅ **Validación de permisos**: No se puede acceder a rutas sin permiso

---

## 📋 Funcionalidades Principales

### 🎯 Gestión de Entidades
- **Estudiantes**: Código único, apellidos, nombres, vinculado a cuenta de usuario
- **Docentes**: Vinculados a usuarios, apellidos, nombres
- **Temas de Consejería** (5 predefinidos):
  - 📚 Plan de estudios y cursos
  - 💼 Desarrollo profesional
  - 🏢 Inserción laboral
  - 📝 Proceso de tesis
  - 🔧 Otros temas
- **Atenciones**: Semestre, fecha, hora, docente, estudiante, tema, consulta, descripción, evidencia (archivo PDF/imagen)

### 📊 Dashboards Personalizados

#### Dashboard Administrador:
- Total de estudiantes, docentes, atenciones, temas
- Gráfico de atenciones por semestre
- Top 10 docentes con más atenciones
- Atenciones por tema
- Últimas 10 atenciones del sistema

#### Dashboard Docente:
- Total de atenciones realizadas
- Atenciones del mes actual
- Estudiantes atendidos
- Botón rápido "Registrar Nueva Atención"
- Gráfico de atenciones por tema
- Últimas 10 atenciones propias

#### Dashboard Estudiante:
- Total de asesorías recibidas
- Asesorías del semestre actual
- Docentes consultados
- Información personal (código, nombre, email)
- Gráfico de asesorías por tema
- Últimas 10 asesorías recibidas

### 📈 Reportes (Solo Admin)
- Filtros avanzados:
  - Por semestre (ej: 2024-1, 2024-2)
  - Por docente específico
  - Por tema de consejería
  - Por rango de fechas
- Exportación de datos
- Estadísticas detalladas

### ✅ Validaciones
- Campos obligatorios en todos los formularios
- Validación de correos institucionales UPT
- Validación de archivos: PDF, JPG, JPEG, PNG (máx. 2MB)
- Códigos únicos de estudiantes
- Fechas y horas válidas

---

## 🎨 Diseño

### Colores UPT
- **Primario**: #800000 (Rojo granate UPT)
- **Secundarios**: 
  - #333333 (Gris oscuro para textos)
  - #F2F2F2 (Gris claro para fondos)

### Características del Diseño
- ✨ Minimalista y profesional
- 📱 Responsive (móvil y escritorio)
- 🧭 Navegación intuitiva
- ⚡ Mensajes de confirmación/error
- 🎯 Formularios con validación en tiempo real

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 12
- **Autenticación**: Laravel Breeze
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Base de Datos**: MySQL
- **Storage**: Laravel Storage (public disk)
- **Diseño**: Responsive con colores institucionales UPT

---

## 📝 Notas Importantes

- ✅ Las evidencias se guardan en `storage/app/public/evidencias`
- ✅ Ejecutar `php artisan storage:link` para acceder a evidencias
- ✅ El middleware `upt.email` valida emails institucionales
- ✅ El middleware `role` protege rutas según permisos
- ✅ Los seeders crean datos de prueba automáticamente
- ✅ Cada rol tiene su propia vista y navegación

---

## 🎓 Para el Profesor - Guía de Revisión

### ✅ Verificar Funcionalidad de Roles:

**1. Probar ADMINISTRADOR:**
```
- Login: admin@upt.pe / admin123
- Verificar: Dashboard completo, gestión de todas las entidades, reportes
```

**2. Probar DOCENTE:**
```
- Login: docente1@upt.pe / docente123
- Verificar: Solo ve sus atenciones, puede crear nuevas, no puede gestionar usuarios
```

**3. Probar ESTUDIANTE:**
```
- Login: estudiante1@virtual.upt.pe / estudiante123
- Verificar: Solo ve sus asesorías, no puede crear ni editar
```

### ✅ Verificar Seguridad:
- Intentar acceder a rutas sin permiso (debe dar error 403)
- Intentar registrar email no-UPT (debe rechazar)
- Verificar que docentes no ven atenciones de otros docentes
- Verificar que estudiantes no ven asesorías de otros estudiantes

### ✅ Verificar CRUD Completo:
- Como ADMIN: Crear, editar, eliminar estudiantes, docentes, temas, atenciones
- Como DOCENTE: Crear y editar atenciones
- Subir evidencias (PDF/imágenes)

### ✅ Verificar Reportes:
- Como ADMIN: Filtrar por semestre, docente, tema, fechas
- Ver estadísticas y gráficos

---

## 🎯 Características Destacadas

1. ✨ **Sistema de Roles Completo**: 3 roles con permisos diferenciados
2. 🔐 **Seguridad**: Middleware de email UPT y verificación de roles
3. 📊 **Dashboards Personalizados**: Cada rol ve información relevante
4. 🎨 **Diseño UPT**: Colores institucionales, profesional y minimalista
5. 📱 **Responsive**: Funciona en móvil, tablet y escritorio
6. 📁 **Carga de Archivos**: Evidencias en PDF e imágenes
7. 📈 **Reportes Avanzados**: Filtros múltiples y estadísticas
8. ✅ **Validaciones**: Formularios con validación completa
9. 🔄 **Navegación Dinámica**: Menú cambia según el rol del usuario
10. 📝 **Datos de Prueba**: 21 usuarios precargados para testing

---

## 📞 Contacto y Soporte

Para dudas o problemas:
- Revisar este README completo
- Verificar credenciales de acceso
- Asegurar que el servidor esté corriendo (`php artisan serve`)
- Verificar conexión a base de datos en `.env`

---

## 📄 Licencia

Sistema desarrollado para la Universidad Privada de Tacna (UPT) - 2025
