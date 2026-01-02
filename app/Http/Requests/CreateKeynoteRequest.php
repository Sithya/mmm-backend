<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateKeynoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        return [
            'page_id' => 'required|exists:pages,id',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'bio_html' => 'nullable|string',
            'body_html' => 'nullable|string',
        ];
    }
}

