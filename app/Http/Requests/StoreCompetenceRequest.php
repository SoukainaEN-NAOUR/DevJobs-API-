<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:50|unique:competences,nom',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la compétence est obligatoire.',
            'nom.unique' => 'Cette compétence existe déjà.',
            'description.required' => 'La description est obligatoire.',
        ];
    }
}