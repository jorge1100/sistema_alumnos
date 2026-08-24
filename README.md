# 📘 Guía de Instalación y Uso — App DocentesAlumnos

> **UTN — Técnicatura Universitaria en Programación | Programación IV**
> Laravel 13 · MySQL · Blade · Tailwind CSS · Breeze

---

## 📋 Descripción del sistema

Aplicación web desarrollada en **Laravel 13** con base de datos **MySQL** que gestiona usuarios con autenticación y roles simples:

- **Docente / Administrador**: puede ver el listado completo de usuarios registrados y el detalle de cada uno.
- **Alumno**: puede registrarse, subir foto de perfil, y acceder y modificar únicamente su propio perfil.

---

## 🛠️ Requisitos previos

| Software | Versión mínima |
|----------|---------------|
| PHP | 8.3 |
| Composer | 2.x |
| Node.js | 18+ |
| MySQL / MariaDB | 5.7+ |
| Git | Cualquiera |

Verificar instalación:
```bash
php -v
composer -v
node -v
mysql --version
```

---

## 🚀 Instalación paso a paso

### 1. Clonar o crear el proyecto

```bash
git clone <url-del-repo> DocentesAlumnos
cd DocentesAlumnos
```

O crear desde cero:
```bash
composer create-project laravel/laravel DocentesAlumnos
cd DocentesAlumnos
```

### 2. Instalar dependencias de Laravel Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
```

Cuando pregunte:
- Stack: **blade**
- Dark mode: **no**
- Pest tests: **no**

### 3. Compilar assets (CSS y JS)

```bash
npm install
npm run build
```

### 4. Configurar la base de datos

Editar el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=docentes_alumnos
DB_USERNAME=root
DB_PASSWORD=tu_password

WHATSAPP_PREFIX=+54
```

Crear la base de datos:
```bash
mysql -u root -p
```
```sql
CREATE DATABASE docentes_alumnos;
EXIT;
```

### 5. Configurar el prefijo de WhatsApp

En `config/app.php`, agregar dentro del array de retorno:

```php
'whatsapp_prefix' => env('WHATSAPP_PREFIX', '+54'),
```

### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto crea:
- La tabla `users` con todos los campos requeridos
- El usuario administrador de prueba

### 7. Crear enlace simbólico para fotos

```bash
php artisan storage:link
```

### 8. Dar permisos (si usás Docker o Linux)

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 9. Levantar el servidor

```bash
php artisan serve
```

Abrir en navegador: `http://localhost:8000`

---

## 🔐 Credenciales de prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| Docente / Admin | `admin@utn.edu.ar` | `password` |
| Alumno | Registrarse desde el formulario | - |

---

## 📁 Estructura de archivos modificados

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/RegisteredUserController.php    ← Registro con campos extra
│   │   ├── ProfileController.php                ← Edición de perfil con foto
│   │   └── Admin/
│   │       └── UserController.php               ← Listado y detalle (admin)
│   ├── Middleware/
│   │   └── IsAdmin.php                          ← Middleware de rol admin
│   ├── Requests/
│   │   ├── StoreUserRequest.php                 ← Validación de registro
│   │   └── UpdateProfileRequest.php             ← Validación de edición
│   ├── Models/
│   │   └── User.php                             ← Modelo con métodos útiles
│   └── Policies/
│       └── UserPolicy.php                       ← Control de acceso
├── Providers/
│   └── AuthServiceProvider.php                  ← Registro de policies

bootstrap/
└── app.php                                      ← Registro de middleware

database/
├── migrations/
│   └── 0001_01_01_000000_create_users_table.php ← Tabla users con campos extra
└── seeders/
    └── DatabaseSeeder.php                       ← Usuario admin de prueba

resources/views/
├── auth/
│   └── register.blade.php                       ← Formulario de registro extendido
├── profile/
│   └── edit.blade.php                           ← Perfil del alumno
│   └── partials/
│       └── update-profile-information-form.blade.php
├── admin/
│   └── users/
│       ├── index.blade.php                      ← Listado de usuarios
│       └── show.blade.php                       ← Detalle de usuario
└── layouts/
    └── navigation.blade.php                     ← Menú con link de admin

routes/
└── web.php                                      ← Rutas protegidas
```

---

## 🎯 Funcionalidades implementadas

### Autenticación y Registro
- Login y registro con Laravel Breeze (Blade)
- Registro con campos: nombre, email, contraseña, teléfono, red profesional, **foto de perfil obligatoria**
- Verificación de email (opcional)
- Recuperación de contraseña

### Roles
- **Administrador (docente)**: `is_admin = true`
  - Acceso a `/admin/users` (listado completo)
  - Acceso a `/admin/users/{id}` (detalle de cualquier usuario)
- **Alumno**: `is_admin = false`
  - Solo puede ver y editar su propio perfil en `/profile`

### Perfil de Usuario
- Foto de perfil visible en perfil y listado
- Teléfono con hipervínculo directo a **WhatsApp** (abre en nueva pestaña)
- Enlace a red profesional (LinkedIn, GitHub, etc.) con `target="_blank"`
- Edición de datos personales y foto

### Seguridad
- Middleware `auth` en rutas protegidas
- Middleware `admin` para rutas de docente
- Validación de formularios con FormRequest
- Policies (`viewAny`, `view`, `update`, `delete`)
- Prefijo de país para WhatsApp configurable en `.env`

---

## 🗄️ Modelo de datos (tabla `users`)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | BIGINT (PK, AI) | Clave primaria |
| `name` | VARCHAR(255) | Nombre completo |
| `email` | VARCHAR(255) | Email único |
| `password` | VARCHAR(255) | Contraseña hasheada |
| `is_admin` | BOOLEAN | `true` = docente, `false` = alumno |
| `phone` | VARCHAR(20) | Teléfono (opcional) |
| `professional_url` | VARCHAR(255) | Red profesional (opcional) |
| `photo_path` | VARCHAR(255) | Ruta de la foto en storage |
| `email_verified_at` | TIMESTAMP | Verificación de email |
| `remember_token` | VARCHAR(100) | Token "recordarme" |
| `created_at` / `updated_at` | TIMESTAMP | Timestamps automáticos |

---

## 🧪 Flujo de uso

### Como Docente
1. Iniciar sesión con `admin@utn.edu.ar` / `password`
2. En el menú superior aparece **"Usuarios"**
3. Hacer clic para ver el listado completo
4. Hacer clic en **"Ver detalle"** para ver datos de un alumno específico
5. Desde el detalle se puede:
   - Ver foto de perfil
   - Hacer clic en el teléfono para abrir WhatsApp
   - Hacer clic en la red profesional para abrir en nueva pestaña

### Como Alumno
1. Hacer clic en **"Registrarse"**
2. Completar todos los campos (foto de perfil es **obligatoria**)
3. Iniciar sesión
4. Ir a **"Perfil"** en el menú desplegable
5. Ver datos personales con links clickeables
6. Editar información personal y cambiar foto de perfil

---

## ⚙️ Configuraciones adicionales

### Cambiar el prefijo de país para WhatsApp
Editar `.env`:
```env
WHATSAPP_PREFIX=+54   # Argentina
# WHATSAPP_PREFIX=+598  # Uruguay
# WHATSAPP_PREFIX=+56   # Chile
```

### Cambiar el usuario administrador
Editar `database/seeders/DatabaseSeeder.php` y volver a ejecutar:
```bash
php artisan migrate:fresh --seed
```

---

## 🐛 Solución de problemas comunes

### Error de permisos en `storage/`
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error "View not found"
Verificar que las vistas estén en `resources/views/admin/users/` (plural).

### La foto no se muestra
1. Verificar que se ejecutó `php artisan storage:link`
2. Verificar permisos de `storage/app/public/profiles/`
3. Verificar que el campo `photo_path` no esté vacío en la base de datos

### Error de base de datos "Column not found"
Ejecutar:
```bash
php artisan migrate:fresh --seed
```

---

## 📚 Tecnologías utilizadas

- **Laravel 13** — Framework PHP
- **MySQL** — Base de datos relacional
- **Blade** — Motor de plantillas
- **Tailwind CSS** — Framework CSS (incluido en Breeze)
- **Laravel Breeze** — Kit de autenticación
- **Vite** — Bundler de assets

---

> Desarrollado para la asignatura **Programación IV** — UTN
