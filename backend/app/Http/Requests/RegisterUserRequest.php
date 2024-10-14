<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nid' => 'required|unique:users,nid',   // NID must be unique
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',   // Email must be unique and valid
            'date' => 'required|date|after_or_equal:today',   // Date must be today or in the future
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',  // Vaccine center must exist
        ];
    }

    public function messages()
    {
        return [
            'nid.required' => 'National ID is required.',
            'nid.unique' => 'You are already registered.',
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'date.required' => 'Please select a vaccination date.',
            'date.date' => 'Please enter a valid date.',
            'date.after_or_equal' => 'The vaccination date cannot be in the past.',
            'vaccine_center_id.required' => 'Please select a vaccine center.',
            'vaccine_center_id.exists' => 'Selected vaccine center is invalid.',
        ];
    }
}


