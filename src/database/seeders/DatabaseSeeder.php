<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador (docente)
        User::create([
            'name' => 'Docente Administrador',
            'email' => 'admin@utn.edu.ar',
            'password' => Hash::make('password'),
            'phone' => '+54 9 351 2345678',
            'professional_url' => 'https://linkedin.com/in/docente-utn',
            'photo_path' => null,
            'is_admin' => true,
        ]);

        $this->command->info('✅ Admin creado: admin@utn.edu.ar / password');
    }
}
