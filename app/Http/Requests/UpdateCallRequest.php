<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Will be protected by admin middleware
    }

    public function rules(): array
    {
        // apiResource uses 'call' as the route parameter name
        $callId = $this->route('call');
        
        return [
            'page_id' => 'sometimes|required|exists:pages,id',
            'title' => 'sometimes|required|string|max:255',
            'type' => 'nullable|string|unique:calls,type,' . $callId,
            'content' => 'nullable|string',
        ];
    }
}

