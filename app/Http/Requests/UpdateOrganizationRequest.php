<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        return [
            'page_id' => 'sometimes|required|exists:pages,id',
            'name' => 'sometimes|required|string|max:255',
            'category' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
        ];
    }
}

