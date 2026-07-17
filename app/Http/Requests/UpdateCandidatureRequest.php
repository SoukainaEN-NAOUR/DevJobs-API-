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
            'date_candidature' => 'sometimes|date',
            'statut' => 'sometimes|in:en_attente,acceptee,refusee',
        ];
    }
}