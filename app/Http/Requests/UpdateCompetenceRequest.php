<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompetenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('competences', 'nom')
                    ->ignore($this->id, 'id_competence'),
            ],
            'description' => 'sometimes|string',
        ];
    }
}