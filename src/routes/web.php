<?php
/**
 * ========================================================================
 * ARCHIVO DE RUTAS: web.php
 * ========================================================================
 * Define todas las rutas web (HTML) de la aplicación.
 * Las rutas API están en routes/api.php.
 *
 * Estructura de rutas:
 *   1. Rutas públicas → accesibles sin login
 *   2. Rutas de perfil → requieren login (middleware 'auth')
 *   3. Rutas de admin → requieren login Y ser admin (middleware 'auth' + 'admin')
 *
 * Prefijos y nombres:
 *   - /admin/* → Rutas del panel de administración
 *   - admin.*  → Nombres de rutas admin (ej: admin.users.index)
 * ========================================================================
 */

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ========================================================================
// RUTAS PÚBLICAS (sin autenticación)
// ========================================================================

// Página de inicio / welcome
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// ========================================================================
// RUTAS DEL DASHBOARD (requieren login + email verificado)
// ========================================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ========================================================================
// RUTAS DE PERFIL (requieren login)
// ========================================================================
// El usuario autenticado puede editar, actualizar y eliminar su perfil.
// NO requiere ser admin.

Route::middleware('auth')->group(function () {
    // Mostrar formulario de edición del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Actualizar datos del perfil (PATCH porque solo modifica parcialmente)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Eliminar la cuenta del usuario (requiere contraseña)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================================================
// RUTAS DE ADMINISTRACIÓN (requieren login + ser admin)
// ========================================================================
// Todas las rutas están protegidas por:
//   - 'auth' → El usuario debe estar logueado
//   - 'admin' → El usuario debe tener is_admin = true (middleware IsAdmin)
//
// Prefijo: /admin → Todas las rutas empiezan con /admin/
// Nombre: admin. → Todas las rutas se nombran con admin. (ej: admin.users.index)

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // ----- GESTIÓN DE ALUMNOS -----
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // ----- GESTIÓN DE ADMINISTRADORES/DOCENTES -----
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
});

// ========================================================================
// RUTAS DE AUTENTICACIÓN (Laravel Breeze)
// ========================================================================
// Login, registro, recuperación de contraseña, verificación de email, etc.
require __DIR__ . '/auth.php';
