<?php
/**
 * ========================================================================
 * FORM REQUEST: StoreAdminRequest
 * ========================================================================
 * Valida los datos del formulario de creación de administradores.
 * Solo los usuarios con rol de administrador pueden usar esta petición.
 *
 * Campos validados:
 *   - name:     requerido, string, máximo 255 caracteres
 *   - email:    requerido, email válido, único en tabla users
 *   - password: requerido, mínimo 8 caracteres (regla Password::defaults)
 *   - phone:    opcional, string, máximo 20 caracteres
 * ========================================================================
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreAdminRequest extends FormRequest
{
    /**
     * ====================================================================
     * AUTHORIZE - Verifica permisos
     * ====================================================================
     * Solo permite el acceso si el usuario está autenticado Y es admin.
     * Si no cumple, Laravel retorna automáticamente un error 403.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * ====================================================================
     * RULES - Reglas de validación
     * ====================================================================
     * Define las reglas para cada campo del formulario.
     * La regla Password::defaults() exige mínimo 8 caracteres.
     *
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'phone'    => ['nullable', 'string', 'max:20'],
        ];
    }

    /**
     * ====================================================================
     * MESSAGES - Mensajes de error personalizados en español
     * ====================================================================
     * Reemplaza los mensajes por defecto de Laravel con textos en español
     * para una mejor experiencia del usuario.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El nombre es obligatorio.',
            'email.required'    => 'El email es obligatorio.',
            'email.unique'      => 'Ese email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
