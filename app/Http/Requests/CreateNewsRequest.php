<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
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
            'content' => 'nullable|string',
            'published_at' => 'nullable|date',
            'link_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
        ];
    }
}

