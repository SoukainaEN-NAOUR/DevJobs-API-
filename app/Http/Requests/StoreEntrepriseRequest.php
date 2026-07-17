<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrepriseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_entreprise' => 'required|string|max:255',
            'secteur' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|string|max:255',
        ];
    }
}