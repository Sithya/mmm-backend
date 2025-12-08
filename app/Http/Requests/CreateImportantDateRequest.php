<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateImportantDateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by auth middleware
    }

    public function rules(): array
    {
        return [
            'due_date' => 'required|date',
            'description' => 'required|string|max:255',
        ];
    }
}

