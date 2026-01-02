<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        return [
            'page_id' => 'sometimes|required|exists:pages,id',
            'content' => 'nullable|string',
            'json' => 'nullable|array',
        ];
    }
}

