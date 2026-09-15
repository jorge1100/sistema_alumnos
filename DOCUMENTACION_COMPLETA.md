# Documentación Completa - Sistema Alumnos

## Resumen del Proyecto

Sistema de gestión de alumnos y docentes desarrollado en **Laravel 13** con **PHP 8.5**, **MySQL/MariaDB**, **Nginx**, **Docker**. Incluye autenticación (Laravel Breeze), panel de administración, formulario de contacto con email, subida de imágenes y panel de mensajes para docentes.

---

## Problemas Resueltos (Cronológico)

### 1. Sistema de Contacto No Funcionaba (Error 500)

**Causa:** Faltaban vistas y configuración de email.

**Solución:**
- Creado `resources/views/contact.blade.php` - Formulario con validación
- Creado `resources/views/emails/contact.blade.php` - Plantilla email HTML
- Configurado **Mailpit** (SMTP local en Docker) para testing de emails
- Rutas en `web.php`:
  ```php
  Route::get('/contacto', [ContactController::class, 'create'])->name('contacto');
  Route::post('/contacto', [ContactController::class, 'send'])->name('contacto.send');
  ```

**Verificación:** `http://localhost:8089/contacto` → 200 OK, emails en `http://localhost:7653` (jorge/123456789)

---

### 2. Error `Undefined variable $slot` en Layout

**Causa:** Componente `x-app-layout` esperaba slots pero layout no los soportaba.

**Solución:** Actualizado `contact.blade.php` para usar correctamente:
```blade
<x-app-layout>
    <x-slot name="header">...</x-slot>
    <!-- contenido directo sin {{ $slot }} -->
</x-app-layout>
```

---

### 3. Permisos Base de Datos (`Access denied for user 'jorge'`)

**Solución:**
```bash
docker exec sistema_alumnos_mariadb mariadb -u root -p123456789 \
  -e "GRANT ALL PRIVILEGES ON laravel.* TO 'jorge'@'%'; FLUSH PRIVILEGES;"
```

---

### 4. Subida de Archivos - Límite 2MB por Defecto

**Problema:** No se podían subir fotos grandes (fotos de perfil, imágenes de contacto).

**Solución completa (3 capas):**

**A. PHP (`php.ini` + Dockerfile):**
```ini
upload_max_filesize = 50M
post_max_size = 50M
max_file_uploads = 20
max_execution_time = 300
memory_limit = 256M
```
```dockerfile
COPY php.ini /usr/local/etc/php/conf.d/uploads.ini
```

**B. Nginx (`nginx/default.conf`):**
```nginx
client_max_body_size 50M;

location /imagen/ {
    alias /var/www/html/imagen/;
    try_files $uri $uri/ =404;
}
```

**C. Laravel Validation (`UpdateProfileRequest.php`):**
```php
'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:51200'], // 50MB
```

**Resultado:** Subida hasta 50MB funcionando.

---

### 5. Acceso a Imágenes Externas (`/imagen/`)

**Requerimiento:** Usuario quería servir imágenes de carpeta `imagen/` fuera de Laravel.

**Solución:**
- Volumen compartido en `docker-compose.yml`:
  ```yaml
  volumes:
    - ./imagen:/var/www/html/imagen
  ```
- Nginx sirve directamente: `http://localhost:8089/imagen/archivo.png`

**Archivos disponibles:**
- `Designer (2) (1).png` (1.1MB)
- `Designer (3).png` (1.9MB)
- `WhatsApp Image 2026-08-03 at 11.24.07 (1).jpeg` (55KB)

---

### 6. Perfil de Usuario - Subida de Foto

**Ya implementado en Breeze, actualizado a 50MB:**

- Vista: `profile/partials/update-profile-information-form.blade.php`
- Controlador: `ProfileController::update()` - Guarda en `storage/app/public/profiles/`
- Modelo: `User::profilePhotoUrl()` - Retorna URL via `asset('storage/' . $path)`

---

### 7. Panel de Mensajes para Docentes (Admin)

**Nueva funcionalidad completa:**

**A. Modelo y Migración:**
```bash
php artisan make:model ContactMessage -m
```
Tabla: `contact_messages` (name, email, subject, message, is_read, read_at)

**B. Controlador Admin (`ContactMessageController`):**
- `index()` - Lista paginada con badges (leído/nuevo)
- `show()` - Detalle, auto-marca como leído
- `destroy()` - Eliminar

**C. Rutas Admin:**
```php
Route::get('/mensajes', [ContactMessageController::class, 'index'])->name('messages.index');
Route::get('/mensajes/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
Route::delete('/mensajes/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
```

**D. Vistas Admin:**
- `admin/messages/index.blade.php` - Tabla con filtros, paginación
- `admin/messages/show.blade.php` - Detalle con email `mailto:`, botón "Marcar como leído"

**E. Navegación:** Link "Mensajes (X)" con badge rojo contador no leídos (solo admins)

---

### 8. Error 500 en Producción - Storage No Configurado

**Problema crítico:** Al clonar repo y hacer `docker compose up`, las imágenes no cargaban.

**Causa raíz:** En producción faltan (gitignored):
- `storage/app/public/` directorio
- Symlink `public/storage` → `storage/app/public`
- Nginx route para `/storage/`
- Permisos correctos

**Solución Definitiva - Automatización en Docker:**

**1. `docker-entrypoint.sh`** (ejecuta al iniciar contenedor PHP):
```bash
#!/bin/bash
set -e

# Crear estructura de directorios
mkdir -p /var/www/html/storage/app/public/profiles
mkdir -p /var/www/html/storage/framework/{views,cache,sessions,testing}
mkdir -p /var/www/html/bootstrap/cache

# Permisos
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Symlink storage
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link
fi

# Cache en producción
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Migraciones
php artisan migrate --force

exec "$@"
```

**2. `Dockerfile` actualizado:**
```dockerfile
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
```

**3. Nginx `/storage/` location:**
```nginx
location /storage/ {
    alias /var/www/html/storage/app/public/;
    try_files $uri $uri/ =404;
    expires 30d;
    add_header Cache-Control "public";
}
```

**4. `.gitkeep` files** para preservar estructura en git:
```
storage/app/public/.gitkeep
storage/framework/views/.gitkeep
storage/framework/cache/.gitkeep
storage/framework/sessions/.gitkeep
bootstrap/cache/.gitkeep
```

**Verificado:**
- `http://localhost:8089/storage/profiles/xxx.png` → 200 OK
- `http://localhost:8089/imagen/Designer%20(2)%20(1).png` → 200 OK

---

## URLs de Acceso

| Servicio | URL | Credenciales |
|----------|-----|--------------|
| App Principal | http://localhost:8089 | - |
| Contacto | http://localhost:8089/contacto | - |
| Login | http://localhost:8089/login | - |
| Perfil | http://localhost:8089/profile | Login requerido |
| Dashboard | http://localhost:8089/dashboard | Login + verified |
| Admin Usuarios | http://localhost:8089/admin/users | Admin |
| **Admin Mensajes** | http://localhost:8089/admin/mensajes | **Admin** |
| Mailpit (Emails) | http://localhost:7653 | jorge / 123456789 |
| Adminer (DB) | http://localhost:8088 | - |
| Imágenes externas | http://localhost:8089/imagen/archivo.png | - |

**Usuarios de prueba:**
- Admin: `admin@test.com` / `password`
- Alumno: `alumno@test.com` / `password`

---

## Comandos Útiles

```bash
# Construir y levantar
docker compose build --no-cache
docker compose up -d

# Ver logs
docker exec sistema_alumnos_php tail -f storage/logs/laravel.log

# Limpiar cachés
docker exec sistema_alumnos_php php artisan config:clear
docker exec sistema_alumnos_php php artisan view:clear
docker exec sistema_alumnos_php php artisan route:clear

# Migraciones
docker exec sistema_alumnos_php php artisan migrate --force

# Storage link (manual si falla)
docker exec sistema_alumnos_php php artisan storage:link

# Permisos (manual si falla)
docker exec -u root sistema_alumnos_php chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
docker exec -u root sistema_alumnos_php chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

---

## Archivos Clave Modificados/Creados

### Configuración Docker/Infraestructura
- `Dockerfile` - PHP 8.5 + extensiones + entrypoint
- `docker-entrypoint.sh` - **NUEVO** - Setup automático storage
- `docker-compose.yml` - Servicios + volúmenes `/imagen`
- `nginx/default.conf` - `/storage/` + `/imagen/` + 50MB
- `php.ini` - Límites upload 50MB

### Contacto
- `src/app/Http/Controllers/ContactController.php` - Guarda en BD + envía email
- `src/app/Mail/ContactMail.php` - Mailable
- `src/resources/views/contact.blade.php` - Formulario
- `src/resources/views/emails/contact.blade.php` - Email template

### Mensajes Admin
- `src/app/Models/ContactMessage.php` - Modelo con scopes
- `src/database/migrations/2026_09_15_005436_create_contact_messages_table.php`
- `src/app/Http/Controllers/Admin/ContactMessageController.php`
- `src/resources/views/admin/messages/index.blade.php`
- `src/resources/views/admin/messages/show.blade.php`

### Perfil/Upload
- `src/app/Http/Requests/UpdateProfileRequest.php` - max:51200 (50MB)
- `src/resources/views/profile/partials/update-profile-information-form.blade.php`

### Navegación
- `src/resources/views/layouts/navigation.blade.php` - Badge "Mensajes (X)"

### Rutas
- `src/routes/web.php` - Rutas contacto + admin mensajes

---

## Estructura de Directorios Importante

```
sistema_alumnos/
├── docker-entrypoint.sh          # Setup automático storage
├── Dockerfile                    # PHP + entrypoint
├── docker-compose.yml            # Servicios
├── nginx/default.conf            # Nginx config
├── php.ini                       # PHP upload limits
├── imagen/                       # Imágenes externas servidas por Nginx
│   ├── Designer (2) (1).png
│   ├── Designer (3).png
│   └── WhatsApp Image 2026-08-03 at 11.24.07 (1).jpeg
└── src/
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── ContactController.php
    │   │   ├── ProfileController.php
    │   │   └── Admin/
    │   │       ├── ContactMessageController.php
    │   │       ├── UserController.php
    │   │       └── AdminController.php
    │   ├── Mail/ContactMail.php
    │   └── Models/
    │       ├── User.php
    │       └── ContactMessage.php
    ├── database/migrations/
    │   └── 2026_09_15_005436_create_contact_messages_table.php
    ├── resources/views/
    │   ├── contact.blade.php
    │   ├── emails/contact.blade.php
    │   ├── profile/partials/update-profile-information-form.blade.php
    │   ├── admin/
    │   │   ├── users/index.blade.php
    │   │   ├── users/show.blade.php
    │   │   └── messages/
    │   │       ├── index.blade.php
    │   │       └── show.blade.php
    │   └── layouts/
    │       ├── app.blade.php
    │       └── navigation.blade.php
    ├── routes/web.php
    └── storage/                  # Creado automáticamente por entrypoint
        ├── app/public/profiles/  # Fotos de perfil subidas
        └── framework/
```

---

## Despliegue en Producción (Checklist)

1. **Clonar repo:** `git clone <repo>`
2. **Configurar `.env`:** Copiar `.env.example` → `.env`, ajustar:
   - `APP_ENV=production`
   - `APP_URL=https://tudominio.com`
   - `DB_*` credenciales reales
   - `MAIL_*` credenciales SMTP reales
3. **SSL:** Colocar certificados en `ssl/server.crt` y `ssl/server.key`
4. **Levantar:** `docker compose up -d --build`
5. **Verificar:** El entrypoint hace todo automáticamente:
   - ✅ Crea directorios storage
   - ✅ Symlink public/storage
   - ✅ Permisos www-data
   - ✅ Migraciones
   - ✅ Cache config/route/view

---

## Troubleshooting Común

| Problema | Solución |
|----------|----------|
| Imágenes no cargan (`/storage/`) | Verificar entrypoint ejecutó, `docker exec sistema_alumnos_php ls -la /var/www/html/public/storage` |
| Error 500 permisos | `docker exec -u root sistema_alumnos_php chown -R www-data:www-data /var/www/html/storage` |
| Upload falla >2MB | Verificar `php.ini` en contenedor: `docker exec sistema_alumnos_php php -i \| grep upload_max` |
| DB connection error | Verificar credenciales `.env` y que contenedor mariadb esté healthy |
| Email no llega | Verificar Mailpit en puerto 7653, o configurar SMTP real en `.env` |

---

## Historial de Commits Relevantes

```
d3f6ced fix: production-ready storage setup (entrypoint, nginx /storage/, .gitkeep)
72e5a0e Merge feature/email into main (contacto, mensajes admin, upload 50MB, imágenes)
303452e feat: contact system, file upload 50MB, admin messages panel
...
```

---

## Próximos Pasos Sugeridos

1. **Tests automatizados** para contact, messages, profile upload
2. **Rate limiting** en formulario contacto
3. **Notificaciones en tiempo real** (Laravel Echo + Pusher/Soketi) para nuevos mensajes
4. **Exportar mensajes** a CSV/PDF
5. **Responder mensajes** desde panel admin (crear hilo de conversación)
6. **Backup automático** BD + storage