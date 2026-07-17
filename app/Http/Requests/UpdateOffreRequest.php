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
        ];
    }



    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',

            'description.required' => 'La description est obligatoire.',

            'type_contrat.required' => 'Le type de contrat est obligatoire.',
        ];
    }

}