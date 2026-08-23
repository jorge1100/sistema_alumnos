<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rules;
use Illuminate\validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        #return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($this->user()->id),],
            'phone' => ['nullable','string','max:20'],
            'professional_url' => ['nullable','url','max:255'],
            'photo' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'El nombre es obligatoio.',
            'email.unique' => 'Ese email ya esta en uso por otro ususario.',
            'professional_url.url' => 'La url debe ser valido.',
            'photo.image' => 'El archivo debe ser una image.',
            'photo.mimes' => 'La foto debe ser JPG o PNG.',
            'photo.max' => 'la fot no puede pesar mas de 2MB.',
        ];

    }
}
