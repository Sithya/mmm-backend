<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by auth middleware
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'type' => 'nullable|in:student,standard,early_bird,group',
        ];
    }
}

