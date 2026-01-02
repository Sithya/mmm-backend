<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        return [
            'page_id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|unique:calls,type',
            'content' => 'nullable|string',
        ];
    }
}

