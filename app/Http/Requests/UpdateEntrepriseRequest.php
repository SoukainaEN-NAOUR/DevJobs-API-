<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntrepriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'nom_entreprise' => 'sometimes|required|string|max:100',
            'secteur' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
        ];
    }

    /**
     * Messages personnalisés.
     */
    public function messages(): array
    {
        return [
            'nom_entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
            'secteur.required' => 'Le secteur est obligatoire.',
        ];
    }
}