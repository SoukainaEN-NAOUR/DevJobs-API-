<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,entreprise,candidat',
        ];
    }

    public function messages(): array
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Email invalide.',
            'role.required' => 'Le rôle est obligatoire.',
            'role.in' => 'Le rôle est invalide.',
        ];
    }
}