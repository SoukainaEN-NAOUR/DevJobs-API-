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
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'type_contrat' => 'sometimes|in:CDI,CDD,Stage,Freelance',
        ];
    }
}