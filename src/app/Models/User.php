<?php
/**
 * ========================================================================
 * MODELO: User
 * ========================================================================
 * Modelo Eloquent que representa a los usuarios del sistema.
 * Extiende de Authenticatable para integrarse con el sistema de
 * autenticación de Laravel (login, sesiones, etc.).
 *
 * Tipos de usuario:
 *   - Admin/Docente: is_admin = true → Puede gestionar todos los usuarios
 *   - Alumno:        is_admin = false → Solo ve su propio perfil
 *
 * Campos de la tabla 'users':
 *   id, name, email, email_verified_at, password, is_admin,
 *   phone, professional_url, photo_path, remember_token,
 *   created_at, updated_at
 * ========================================================================
 */

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * ====================================================================
     * ATRIBUTOS MASIVAMENTE ASIGNABLES (fillable)
     * ====================================================================
     * Lista de campos que se pueden asignar masivamente con create() o
     * fill(). Protege contra asignación masiva no intencionada.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'professional_url',
        'photo_path',
        'is_admin',
    ];

    /**
     * ====================================================================
     * ATRIBUTOS OCULTOS (hidden)
     * ====================================================================
     * Campos que nunca se muestran en JSON o arrays (seguridad).
     * La contraseña y el token de recordar nunca deben exponerse.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * ====================================================================
     * TRANSFORMACIONES AUTOMÁTICAS (casts)
     * ====================================================================
     * Convierte tipos de datos al acceder a los atributos:
     *   - email_verified_at → objeto Carbon (datetime)
     *   - password → se encripta automáticamente al guardar (hashed)
     *   - is_admin → se convierte a boolean true/false
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * ====================================================================
     * MÉTODO: isAdmin()
     * ====================================================================
     * Retorna true si el usuario es administrador (docente).
     * Se usa en el middleware IsAdmin y en las vistas para mostrar
     * contenido diferenciado según el rol.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * ====================================================================
     * MÉTODO: isAlumno()
     * ====================================================================
     * Retorna true si el usuario es alumno (no es admin).
     * Método auxiliar para claridad en el código.
     *
     * @return bool
     */
    public function isAlumno(): bool
    {
        return !$this->is_admin;
    }

    /**
     * ====================================================================
     * MÉTODO: phoneWithPrefix()
     * ====================================================================
     * Retorna el número de teléfono con el prefijo de WhatsApp (+54).
     * Se usa para generar links directos a WhatsApp:
     *   https://wa.me/+5493511234567
     *
     * El prefijo se obtiene de config('app.whatsapp_prefix').
     * Si no tiene teléfono, retorna null.
     *
     * @return string|null
     */
    public function phoneWithPrefix(): ?string
    {
        if (empty($this->phone)) {
            return null;
        }

        // Obtener prefijo de WhatsApp desde la configuración
        $prefix = config('app.whatsapp_prefix', '+54');

        // Eliminar todos los caracteres que no sean números
        $phone = preg_replace('/[0-9]/', '', $this->phone);

        return $prefix . $phone;
    }

    /**
     * ====================================================================
     * MÉTODO: profilePhotoUrl()
     * ====================================================================
     * Retorna la URL de la foto de perfil del usuario.
     * Si tiene foto personalizada, retorna la URL desde Storage.
     * Si no tiene foto, retorna la imagen por defecto (default-avatar).
     *
     * @return string  URL completa de la imagen
     */
    public function profilePhotoUrl(): string
    {
        if ($this->photo_path) {
            // La foto está en storage/app/public/profiles/
            // Se accede públicamente vía /storage/profiles/...
            return asset('storage/' . $this->photo_path);
        }

        // Imagen por defecto si no tiene foto
        return asset('images/default-avatar.png');
    }
}
