<?php
/**
 * ========================================================================
 * MIGRACIÓN: create_users_table
 * ========================================================================
 * Crea las tablas iniciales del sistema de autenticación:
 *
 * 1. users - Tabla principal de usuarios
 *    - id:                    ID autoincremental
 *    - name:                  Nombre completo
 *    - email:                 Email único (para login)
 *    - email_verified_at:     Fecha de verificación del email
 *    - password:              Contraseña encriptada (bcrypt)
 *    - is_admin:              Rol (false=alumno, true=docente/admin)
 *    - phone:                 Teléfono opcional (max 20 chars)
 *    - professional_url:      URL de LinkedIn u otra red profesional
 *    - photo_path:            Ruta de la foto de perfil en Storage
 *    - remember_token:        Token para "recordarme"
 *    - created_at/updated_at: Timestamps automáticos
 *
 * 2. password_reset_tokens - Tokens para recuperación de contraseña
 * 3. sessions - Sesiones de usuario (database driver)
 * ========================================================================
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración (crea las tablas).
     */
    public function up(): void
    {
        // --- Tabla de usuarios ---
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);  // false = alumno, true = admin
            $table->string('phone', 20)->nullable();
            $table->string('professional_url')->nullable();
            $table->string('photo_path')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // --- Tabla de tokens de recuperación de contraseña ---
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // --- Tabla de sesiones (para database session driver) ---
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Revierte la migración (elimina las tablas).
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
