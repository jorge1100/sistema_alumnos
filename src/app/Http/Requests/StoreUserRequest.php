<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determina si el ususario puede hacer esta peticion.
     * El registro es publico, cualquiere puede haceder.
     */
    public function authorize(): bool
    {
        #return false;
        return true;
    }

    /**
     * Regla de validacion para el registro.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'professional_url' => ['nullable', 'url', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png','max:2048'],

        ];
    }

    /**
     *Manejo de error personalizados
     */

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Ese email ya esta registrado.',
            'password.required' => 'La contraceña es obligatorio.',
            'password.confirmed' => 'La contraceña no coincide.',
            'professional_url.url' => 'La URL debe ser valida (ejemplo: https://linkedin.com/in/jorge).',
            'photo.required' => 'La foto de perfil es obligatorio.',
            'photo.image' => 'El archivo debe ser una imagen',
            'photo.mimes' => 'La foto debe ser JPG o JPG.',
            'photo.max' => 'La foto no puede pesar mas de 2MB.',
        ];

    }

}
