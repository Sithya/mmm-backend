<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Registration type
            'registration_type' => [
                'required',
                Rule::in(['student', 'standard', 'early_bird']),
            ],

            // Personal information
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',

            // Optional fields
            'affiliation' => 'nullable|string|max:255',

            // Location
            'country' => 'required|string|max:255',

            // Dietary restrictions (optional)
            'dietary_restrictions' => 'nullable|string|max:1000',

            // Legal agreement
            'agreed_to_terms' => 'required|boolean',
        ];
    }
    
    public function messages(): array
    {
        return [
            'registration_type.required' => 'Please select a registration type.',
            'registration_type.in' => 'Invalid registration type selected.',

            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',

            'email.required' => 'Email address is required.',
            'email.email'    => 'Please provide a valid email address.',

            'country.required' => 'Please select your country.',

            'agreed_to_terms.required' => 'You must agree to the terms and conditions.',
            'agreed_to_terms.boolean'  => 'Invalid agreement value.',
        ];
    }
}
