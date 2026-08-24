<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
     * Muestra el perfil del ususario logueado.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualizar la informacion del perfil.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = $request->validated();
        $validated = $request->validated();

        //si subio una nueva foto, reemplazar la anterior.
        if ($request->hasFile('photo')) {
            //Borrar la foto anterior si existe
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }
            // Guardar la nueva foto
            $validated['photo_path'] = $request->file('photo')->store('profile', 'public');
        }

        //Actualizar los capos.
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'professional_url' => $validated['professional_url'] ?? null,
        ]);

        // Solo Actualizar photo_path si se subio una nueva foto
        if (isset($validated['photo_path'])) {
            $user->photo_path = $validated['photo_path'];
        }

        // Si cambio el email, deverificar
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Eliminar la cuenta del ususario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        //Borrar la foto del Storage

        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
