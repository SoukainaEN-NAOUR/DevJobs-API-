<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidatureRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        return [
            'id_offre' => 'sometimes|exists:offres,id_offre',
        ];
    }



    public function messages(): array
    {
        return [
            'id_offre.exists' => 'Cette offre n\'existe pas.',
        ];
    }

}