# 🎓 DocentesAlumnos

> Trabajo Práctico Integrador - Programación IV  
> Técnicatura Universitaria en Programación - UTN

Aplicación web desarrollada con **Laravel 13** que permite la gestión de usuarios con autenticación, perfiles personalizados y control de acceso mediante roles.

---

## 📖 Descripción

El sistema implementa dos tipos de usuarios:

### 👨‍🏫 Docente / Administrador

- Acceso al listado completo de usuarios registrados.
- Visualización del detalle de cada alumno.
- Consulta de información de contacto.
- Acceso a enlaces de WhatsApp y redes profesionales.

### 👨‍🎓 Alumno

- Registro de cuenta.
- Carga de fotografía de perfil.
- Visualización de su información personal.
- Edición de sus propios datos.
- Acceso a enlaces personales.

---

## ✨ Funcionalidades Implementadas

### 🔐 Autenticación

- Login de usuarios.
- Registro de nuevos usuarios.
- Recuperación de contraseña.
- Gestión de sesiones.
- Protección de rutas mediante middleware.

### 👤 Gestión de Perfil

- Foto de perfil obligatoria.
- Teléfono configurable.
- Enlace a red profesional (LinkedIn, GitHub, Portfolio, etc.).
- Edición de datos personales.
- Actualización de fotografía.

### 👥 Gestión de Roles

- Administrador (`is_admin = true`)
- Alumno (`is_admin = false`)

### 🛡️ Seguridad

- Middleware de autenticación.
- Middleware de administrador.
- Policies de autorización.
- Validación mediante Form Requests.
- Contraseñas encriptadas con Hash.

### 📱 Integración con WhatsApp

Los teléfonos registrados pueden abrir una conversación directamente mediante un enlace generado automáticamente.

---

# 🏗️ Arquitectura

```text
Laravel 13
│
├── Blade
├── Breeze
├── Tailwind CSS
├── MySQL
├── Vite
└── Docker
```

---

# 📂 Estructura Principal del Proyecto

```text
app
├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests
│
├── Models
│
└── Policies

database
├── migrations
└── seeders

resources
├── views
│   ├── admin
│   ├── auth
│   └── profile

routes
└── web.php
```

---

# 🗄️ Modelo de Datos

## Tabla: users

| Campo | Tipo |
|---------|---------|
| id | BIGINT |
| name | VARCHAR(255) |
| email | VARCHAR(255) |
| password | VARCHAR(255) |
| is_admin | BOOLEAN |
| phone | VARCHAR(20) |
| professional_url | VARCHAR(255) |
| photo_path | VARCHAR(255) |
| email_verified_at | TIMESTAMP |
| remember_token | VARCHAR(100) |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

# 🐳 Instalación con Docker

## Requisitos

- Docker Desktop
- Docker Compose
- Git

Verificar instalación:

```bash
docker --version
docker compose version
git --version
```

---

## 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/TU-USUARIO/DocentesAlumnos.git

cd DocentesAlumnos
```

---

## 2️⃣ Copiar variables de entorno

```bash
cp .env.example .env
```

---

## 3️⃣ Levantar contenedores

```bash
docker compose up -d --build
```

---

## 4️⃣ Generar clave de Laravel

```bash
docker compose exec app php artisan key:generate
```

---

## 5️⃣ Ejecutar migraciones y seeders

```bash
docker compose exec app php artisan migrate:fresh --seed
```

---

## 6️⃣ Crear enlace para almacenamiento

```bash
docker compose exec app php artisan storage:link
```

---

## 7️⃣ Acceder a la aplicación

```text
http://localhost:8000
```

---

# 🔑 Usuario de Prueba

## Administrador

```text
Email: admin@utn.edu.ar
Password: password
```

---

# 🧪 Casos de Uso

## Como Alumno

1. Registrarse.
2. Cargar fotografía.
3. Iniciar sesión.
4. Visualizar perfil.
5. Modificar información personal.

---

## Como Docente

1. Iniciar sesión.
2. Acceder al menú "Usuarios".
3. Visualizar listado completo.
4. Consultar el detalle de cualquier alumno.

---

# ⚙️ Variables de Entorno

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=docentes_alumnos
DB_USERNAME=laravel
DB_PASSWORD=secret

WHATSAPP_PREFIX=+54
```

---

# 🔨 Comandos Útiles

### Ver logs

```bash
docker compose logs -f
```

### Reiniciar servicios

```bash
docker compose restart
```

### Acceder al contenedor

```bash
docker compose exec app bash
```

### Detener aplicación

```bash
docker compose down
```

### Eliminar y reconstruir todo

```bash
docker compose down -v
docker compose up -d --build
```

---

# 📚 Tecnologías Utilizadas

- PHP 8.3
- Laravel 13
- MySQL 8
- Laravel Breeze
- Blade
- Tailwind CSS
- Vite
- Docker
- Docker Compose

---

# 🎯 Objetivos Académicos Alcanzados

✅ Arquitectura MVC

✅ Autenticación y autorización

✅ Relaciones con base de datos MySQL

✅ Formularios y validaciones

✅ Gestión de archivos e imágenes

✅ Middleware personalizados

✅ Policies de autorización

✅ Dockerización de aplicaciones Laravel

✅ Buenas prácticas de desarrollo

---

# 👨‍💻 Autor

**Jorge Rojas**

Técnicatura Universitaria en Programación  
Universidad Tecnológica Nacional (UTN)

---

## 📸 Evidencias del Sistema

> Se recomienda agregar capturas de pantalla del:
>
> - Login
> - Registro
> - Perfil de alumno
> - Listado de usuarios
> - Detalle de usuario
> - Base de datos
>
> para complementar la presentación del proyecto.

---

⭐ Proyecto desarrollado como Trabajo Práctico para la asignatura **Programación IV** utilizando Laravel 13, MySQL y Docker.
