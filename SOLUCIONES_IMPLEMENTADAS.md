# Soluciones Implementadas - Sistema Alumnos

## Resumen de Problemas Resueltos

### 1. Sistema de Contacto No Funcionaba

**Problema:** La página de contacto daba error 500 y no enviaba correos.

**Soluciones aplicadas:**

#### A. Vistas Faltantes Creadas
- **`resources/views/contact.blade.php`** - Formulario de contacto completo con validación
- **`resources/views/emails/contact.blade.php`** - Plantilla de email HTML profesional

#### B. Rutas Ya Existían (web.php)
```php
Route::get('/contacto', [ContactController::class, 'create'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'send'])->name('contacto.send');
```

#### C. Controlador Funcionando (ContactController.php)
```php
public function send(Request $request) {
    $validated = $request->validate([...]);
    Mail::to('admin@sistemaalumnos.com')->send(new ContactMail($validated));
    return back()->with('success', 'Mensaje enviado correctamente.');
}
```

#### D. Configuración de Email (Mailpit)
- Docker Compose incluye servicio Mailpit en puerto 7653 (UI) y 9432 (SMTP)
- Variables .env configuradas:
```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
```

**Resultado:** Contacto funcionando en `http://localhost:8089/contacto` - Emails visibles en `http://localhost:7653` (jorge/123456789)

---

### 2. Error de Variable `$slot` en Layout

**Problema:** `Undefined variable $slot` en `layouts/app.blade.php:32`

**Causa:** El componente `x-app-layout` esperaba usar slots de Blade pero el layout no los soportaba nativamente.

**Solución:** Actualicé `contact.blade.php` para usar correctamente el componente `<x-app-layout>` con `<x-slot name="header">` y contenido directo (sin `{{ $slot }}`).

---

### 3. Permisos de Base de Datos

**Problema:** `Access denied for user 'jorge'@'%' to database 'laravel'`

**Solución:**
```bash
docker exec sistema_alumnos_mariadb mariadb -u root -p123456789 \
  -e "GRANT ALL PRIVILEGES ON laravel.* TO 'jorge'@'%'; FLUSH PRIVILEGES;"
```

---

### 4. Subida de Archivos - Límites Aumentados a 50MB

**Problema:** No se podían subir fotos grandes (límite 2MB por defecto)

**Cambios realizados:**

#### A. PHP Configuration (`php.ini` + Dockerfile)
```ini
file_uploads = On
upload_max_filesize = 50M
post_max_size = 50M
max_file_uploads = 20
max_execution_time = 300
memory_limit = 256M
```
Dockerfile: `COPY php.ini /usr/local/etc/php/conf.d/uploads.ini`

#### B. Nginx Configuration (`nginx/default.conf`)
```nginx
client_max_body_size 50M;

location /imagen/ {
    alias /var/www/html/imagen/;
    try_files $uri $uri/ =404;
}
```

#### C. Docker Compose - Volúmenes Compartidos
```yaml
php:
  volumes:
    - ./src:/var/www/html
    - ./imagen:/var/www/html/imagen

nginx:
  volumes:
    - ./src:/var/www/html
    - ./imagen:/var/www/html/imagen
```

#### D. Validación Laravel (`UpdateProfileRequest.php`)
```php
'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:51200'], // 50MB
```

#### E. Storage Link
```bash
docker exec sistema_alumnos_php php artisan storage:link
```

**Resultado:** Subida de fotos hasta 50MB funcionando en perfil

---

### 5. Acceso a Imágenes Externas (`/imagen/`)

**Problema:** Usuario quería acceder a fotos en carpeta `imagen/` fuera de Laravel

**Solución:**
- Carpeta montada en contenedores: `./imagen:/var/www/html/imagen`
- Nginx sirve directamente: `http://localhost:8089/imagen/archivo.png`
- Accesibles desde Blade: `<img src="/imagen/Designer%20(2)%20(1).png">`

**Archivos disponibles:**
- `Designer (2) (1).png` (1.1MB)
- `Designer (3).png` (1.9MB)
- `WhatsApp Image 2026-08-03 at 11.24.07 (1).jpeg` (55KB)

---

### 6. Perfil de Usuario - Subida de Foto

**Ya implementado en el sistema (Breeze):**

#### Vista: `profile/partials/update-profile-information-form.blade.php`
```blade
<input id="photo" name="photo" type="file" accept="image/*" ...>
<p class="mt-1 text-xs text-gray-500">JPG o PNG. Máximo 50MB.</p>
```

#### Controlador: `ProfileController::update()`
```php
if ($request->hasFile('photo')) {
    if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
        Storage::disk('public')->delete($user->photo_path);
    }
    $user->photo_path = $request->file('photo')->store('profiles', 'public');
}
```

#### Modelo: `User::profilePhotoUrl()`
```php
public function profilePhotoUrl(): string {
    if ($this->photo_path) {
        return asset('storage/' . $this->photo_path);
    }
    return asset('images/default-avatar.png');
}
```

---

## URLs de Acceso

| Servicio | URL | Credenciales |
|----------|-----|--------------|
| Aplicación Principal | http://localhost:8089 | - |
| Contacto | http://localhost:8089/contacto | - |
| Login | http://localhost:8089/login | - |
| Perfil | http://localhost:8089/profile | Requiere login |
| Dashboard | http://localhost:8089/dashboard | Requiere login |
| Mailpit (Emails) | http://localhost:7653 | jorge / 123456789 |
| Adminer (DB) | http://localhost:8088 | - |
| Imágenes externas | http://localhost:8089/imagen/archivo.png | - |

---

## Comandos Útiles

```bash
# Reconstruir contenedores
docker compose build --no-cache php nginx
docker compose up -d

# Limpiar cachés Laravel
docker exec sistema_alumnos_php php artisan config:clear
docker exec sistema_alumnos_php php artisan view:clear
docker exec sistema_alumnos_php php artisan route:clear

# Ver logs
docker exec sistema_alumnos_php tail -f storage/logs/laravel.log

# Ejecutar migraciones
docker exec sistema_alumnos_php php artisan migrate --force

# Storage link (si se pierde)
docker exec sistema_alumnos_php php artisan storage:link
```

---

## Archivos Modificados/Creados

### Nuevos:
- `resources/views/contact.blade.php`
- `resources/views/emails/contact.blade.php`
- `php.ini`
- `SOLUCIONES_IMPLEMENTADAS.md` (este archivo)

### Modificados:
- `Dockerfile` - Agregado COPY php.ini
- `nginx/default.conf` - client_max_body_size 50M + location /imagen/
- `docker-compose.yml` - Volúmenes ./imagen compartidos
- `src/app/Http/Requests/UpdateProfileRequest.php` - max:51200 (50MB)
- `src/resources/views/profile/partials/update-profile-information-form.blade.php` - Texto 50MB

---

## Pruebas Realizadas

✅ Contacto: GET /contacto = 200 OK
✅ Contacto: POST envía email visible en Mailpit
✅ Imágenes externas: GET /imagen/*.png = 200 OK
✅ PHP upload_max_filesize = 50M confirmado
✅ Nginx client_max_body_size = 50M confirmado
✅ Storage link creado correctamente
✅ Perfil: Formulario de foto actualizado a 50MB