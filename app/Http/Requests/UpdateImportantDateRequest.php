<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImportantDateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by auth middleware
    }

    public function rules(): array
    {
        return [
            'due_date' => 'sometimes|required|date',
            'description' => 'sometimes|required|string|max:255',
        ];
    }
}

