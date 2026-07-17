<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prenom' => 'sometimes|string|max:255',
            'nom' => 'sometimes|string|max:255',

            'email' => [
                'sometimes',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($this->id, 'id_user'),
            ],

            'role' => 'sometimes|in:admin,entreprise,candidat',
        ];
    }
}