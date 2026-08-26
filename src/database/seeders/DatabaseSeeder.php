<?php
/**
 * ========================================================================
 * DATABASE SEEDER: DatabaseSeeder
 * ========================================================================
 * Seeder principal que se ejecuta con: php artisan db:seed
 * Crea el primer usuario administrador (docente) del sistema.
 *
 * Datos del admin por defecto:
 *   Email:    profe@profe.com
 *   Password: 123456789
 *   Rol:      Administrador (is_admin = true)
 * ========================================================================
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta el seeder principal.
     * Crea el usuario administrador inicial del sistema.
     */
    public function run(): void
    {
        // Crear usuario administrador (docente)
        User::create([
            'name'             => 'Docente Administrador',
            'email'            => 'profe@profe.com',
            'password'         => Hash::make('123456789'),
            'phone'            => '+54 9 351 2345678',
            'professional_url' => 'https://linkedin.com/in/docente-utn',
            'photo_path'       => null,
            'is_admin'         => true,
        ]);

        // Mensaje de confirmación en consola
        $this->command->info('✅ Admin creado: profe@profe.com / 123456789');
    }
}
