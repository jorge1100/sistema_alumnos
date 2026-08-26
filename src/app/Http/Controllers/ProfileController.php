<?php
/**
 * ========================================================================
 * CONTROLADOR: ProfileController
 * ========================================================================
 * Gestiona el perfil del usuario autenticado (cualquier rol).
 * Permite ver, actualizar y eliminar la cuenta propia.
 *
 * Rutas asociadas (protegidas por middleware 'auth'):
 *   GET    /profile  → edit()   (mostrar formulario de edición)
 *   PATCH  /profile  → update() (guardar cambios del perfil)
 *   DELETE /profile  → destroy() (eliminar la cuenta)
 * ========================================================================
 */

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * ====================================================================
     * EDIT - Mostrar formulario de edición del perfil
     * ====================================================================
     * Retorna la vista profile.edit con los datos del usuario logueado.
     * La vista muestra los campos: nombre, email, teléfono, URL profesional,
     * foto de perfil y contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * ====================================================================
     * UPDATE - Actualizar los datos del perfil
     * ====================================================================
     * Recibe los datos validados por UpdateProfileRequest.
     * Si se sube una nueva foto, elimina la anterior y guarda la nueva.
     * Si cambia el email, desverifica para que vuelva a confirmar.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // --- Gestión de foto de perfil ---
        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe en el disco público
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Guardar la nueva foto en storage/app/public/profiles/
            $user->photo_path = $request->file('photo')->store('profiles', 'public');
        }

        // --- Actualizar campos del perfil ---
        $user->name             = $validated['name'];
        $user->email            = $validated['email'];
        $user->phone            = $validated['phone'] ?? null;
        $user->professional_url = $validated['professional_url'] ?? null;

        // --- Si cambió el email, desverificar ---
        // isDirty() verifica si el campo cambió pero aún no se guardó
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Redirigir al perfil con mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * ====================================================================
     * DESTROY - Eliminar la cuenta del usuario
     * ====================================================================
     * Requiere confirmar la contraseña actual por seguridad.
     * Elimina la foto del storage, cierra la sesión, invalida la
     * sesión y redirige al inicio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validar que la contraseña actual sea correcta
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Cerrar sesión antes de eliminar
        Auth::logout();

        // Eliminar la foto de perfil del storage
        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        // Eliminar el usuario de la base de datos
        $user->delete();

        // Invalidar la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al inicio
        return Redirect::to('/');
    }
}
