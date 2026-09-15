<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


// rutas que ya vienen con Breeze (login, registro, perfil, etc.)
// No las toques
//

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// ==================================================
// RUTAS DEL ADMINISTRADOR(DOCENTE) - Protegidas
// ==================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    
    // Mensajes de contacto
    Route::get('/mensajes', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/mensajes/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/mensajes/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
});

// ==================================================
// RUTAS DEL CONTACTO
// ==================================================

Route::get('/contacto', [ContactController::class, 'create'])
    ->name('contacto');

Route::post('/contacto', [ContactController::class, 'send'])
    ->name('contacto.send');
