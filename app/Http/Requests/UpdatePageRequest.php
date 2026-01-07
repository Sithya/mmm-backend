<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        // apiResource uses 'page' as the route parameter name
        $page = $this->route('page');
        $pageId = $page instanceof \App\Models\Page ? $page->id : $page;
        
        return [
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,' . $pageId,
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
            'json' => 'nullable|array',
            'component' => 'nullable|string|max:255',
        ];
    }
}

