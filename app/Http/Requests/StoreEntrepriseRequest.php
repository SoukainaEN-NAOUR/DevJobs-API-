<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrepriseRequest extends FormRequest
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
        'nom_entreprise' => 'required|string|max:100',
        'secteur' => 'required|string|max:50',
        'description' => 'required|string|max:255',
        'logo' => 'nullable|string|max:255',
        'id_user' => 'required|exists:users,id_user',
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
    }}