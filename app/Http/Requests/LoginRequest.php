<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'rfc' => 'required|string|max:13|regex:/^[A-Za-z&Ñ]{3,4}[0-9]{6}$/',
            'password' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'rfc.required' => 'El campo RFC es obligatorio.',
            'rfc.max' => 'El RFC no puede tener más de 13 caracteres.',
            'rfc.regex' => 'El formato del RFC no es válido. Debe contener 3-4 letras seguidas de 6 números.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => 'correo electrónico',
            'rfc' => 'RFC',
            'password' => 'contraseña',
        ];
    }
} 