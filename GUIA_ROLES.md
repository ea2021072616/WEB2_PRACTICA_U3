# Sistema de Consejería UPT - Guía de Uso

## 🎯 Sistema Implementado

El sistema ahora tiene **3 ROLES diferentes** con vistas y permisos específicos:

---

## 👤 ROLES Y CREDENCIALES

### 1. ADMINISTRADOR 🔴
**Credenciales:**
- Email: `admin@upt.pe`
- Password: `admin123`

**Permisos:**
- ✅ Ver dashboard completo con todas las estadísticas
- ✅ CRUD completo de Estudiantes
- ✅ CRUD completo de Docentes
- ✅ CRUD completo de Temas
- ✅ CRUD completo de Atenciones (todas)
- ✅ Reportes avanzados con filtros
- ✅ Ver todas las atenciones del sistema

**Dashboard:** `/admin/dashboard`

---

### 2. DOCENTE 👨‍🏫
**Credenciales disponibles:**
- `maria.gonzalez@upt.pe` / `password`
- `jose.ramirez@upt.pe` / `password`
- `ana.torres@virtual.upt.pe` / `password`
- `luis.fernandez@upt.pe` / `password`
- `carmen.salazar@upt.pe` / `password`

**Permisos:**
- ✅ Ver su dashboard personalizado
- ✅ Ver solo SUS atenciones
- ✅ Crear nuevas atenciones
- ✅ Editar sus propias atenciones
- ✅ Ver estadísticas de sus atenciones por tema
- ❌ No puede ver atenciones de otros docentes
- ❌ No puede eliminar atenciones
- ❌ No puede gestionar estudiantes/docentes/temas

**Dashboard:** `/docente/dashboard`

---

### 3. ESTUDIANTE 👨‍🎓
**Credenciales disponibles (15 estudiantes):**
- `juan.mamani2020@virtual.upt.pe` / `password`
- `maria.flores2020@virtual.upt.pe` / `password`
- `pedro.gutierrez2021@virtual.upt.pe` / `password`
- `ana.chavez2021@virtual.upt.pe` / `password`
- `luis.vargas2021@virtual.upt.pe` / `password`
- (y 10 más...)

**Permisos:**
- ✅ Ver su dashboard personalizado
- ✅ Ver solo SUS asesorías
- ✅ Ver estadísticas de sus consultas por tema
- ✅ Ver información de sus docentes consultados
- ❌ No puede crear atenciones
- ❌ No puede editar atenciones
- ❌ No puede ver atenciones de otros estudiantes
- ❌ No puede gestionar entidades

**Dashboard:** `/estudiante/dashboard`

---

## 🔐 CÓMO FUNCIONA EL LOGIN

1. **Ingresa a:** http://localhost:8000
2. **Redirige automáticamente a:** `/login`
3. **Ingresa credenciales** de cualquiera de los roles
4. **El sistema detecta automáticamente tu rol** y te lleva al dashboard correspondiente:
   - Si eres **ADMIN** → `/admin/dashboard`
   - Si eres **DOCENTE** → `/docente/dashboard`
   - Si eres **ESTUDIANTE** → `/estudiante/dashboard`

---

## 🎨 NAVEGACIÓN POR ROL

### Menú Administrador:
```
- Dashboard
- Atenciones (todas)
- Estudiantes
- Docentes
- Temas
- Reportes
```

### Menú Docente:
```
- Dashboard
- Mis Atenciones
```

### Menú Estudiante:
```
- Dashboard
- Mis Asesorías
```

---

## 📊 DASHBOARDS DIFERENCIADOS

### Dashboard Administrador:
- Total de estudiantes, docentes, atenciones, temas
- Gráfico de atenciones por semestre
- Gráfico de atenciones por tema
- Top 10 docentes con más atenciones
- Últimas 10 atenciones registradas

### Dashboard Docente:
- Total de sus atenciones
- Atenciones del mes actual
- Estudiantes atendidos
- Botón para registrar nueva atención
- Gráfico de sus atenciones por tema
- Sus últimas 10 atenciones

### Dashboard Estudiante:
- Total de sus asesorías
- Asesorías del semestre actual
- Docentes consultados
- Información personal (código, nombre, email)
- Gráfico de sus asesorías por tema
- Sus últimas 10 asesorías

---

## 🔒 SEGURIDAD

- ✅ Middleware `upt.email`: Solo permite emails @upt.pe o @virtual.upt.pe
- ✅ Middleware `role`: Verifica que el usuario tenga el rol correcto
- ✅ Las rutas están protegidas por rol
- ✅ Los datos se filtran automáticamente según el rol:
  - Docentes solo ven sus atenciones
  - Estudiantes solo ven sus asesorías
  - Admin ve todo

---

## 🚀 PROBANDO EL SISTEMA

### 1. Probar como ADMINISTRADOR:
```
1. Login con: admin@upt.pe / admin123
2. Verás dashboard completo
3. Puedes gestionar TODO el sistema
4. Acceso a reportes avanzados
```

### 2. Probar como DOCENTE:
```
1. Login con: maria.gonzalez@upt.pe / password
2. Verás tu dashboard personal
3. Solo tus atenciones registradas
4. Puedes registrar nuevas atenciones
```

### 3. Probar como ESTUDIANTE:
```
1. Login con: juan.mamani2020@virtual.upt.pe / password
2. Verás tu dashboard personal
3. Solo tus asesorías
4. Código: 2020057001
```

---

## 🎯 DATOS DE PRUEBA INCLUIDOS

El sistema incluye datos de prueba:
- ✅ 1 Administrador
- ✅ 5 Docentes
- ✅ 15 Estudiantes
- ✅ 5 Temas de consejería
- ✅ Múltiples atenciones registradas

---

## 🌐 URLS PRINCIPALES

- **Login:** http://localhost:8000/login
- **Dashboard Principal:** http://localhost:8000/dashboard (redirige según rol)
- **Dashboard Admin:** http://localhost:8000/admin/dashboard
- **Dashboard Docente:** http://localhost:8000/docente/dashboard
- **Dashboard Estudiante:** http://localhost:8000/estudiante/dashboard
- **Reportes Admin:** http://localhost:8000/admin/reportes

---

## 💡 DIFERENCIAS CLAVE

### Antes (sin roles):
- ❌ Todos veían lo mismo
- ❌ Todos tenían los mismos permisos
- ❌ No había distinción entre usuarios

### Ahora (con roles):
- ✅ Cada rol tiene su propio dashboard
- ✅ Cada rol ve solo lo que le corresponde
- ✅ Navegación diferente por rol
- ✅ Permisos específicos por rol
- ✅ Vistas personalizadas por rol

---

## 📧 RECORDATORIO

**Solo se pueden registrar emails que terminen en:**
- `@upt.pe` (corporativos)
- `@virtual.upt.pe` (estudiantes)

**Cualquier otro dominio será rechazado automáticamente.**

---

¡El sistema está completamente funcional con el sistema de roles implementado! 🎉
