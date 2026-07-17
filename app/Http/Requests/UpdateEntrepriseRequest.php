<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntrepriseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_entreprise' => 'sometimes|string|max:255',
            'secteur' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'logo' => 'nullable|string|max:255',
        ];
    }
}