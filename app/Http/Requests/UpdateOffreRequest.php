<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:100',
            'description' => 'required|string',
            'type_contrat' => 'required|string|max:50',
            'id_entreprise' => 'required|exists:entreprises,id_entreprise',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'type_contrat.required' => 'Le type de contrat est obligatoire.',
            'id_entreprise.required' => 'L\'entreprise est obligatoire.',
            'id_entreprise.exists' => 'Cette entreprise n\'existe pas.',
        ];
    }
}