<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:11|unique:user_profiles',
            'sex_id' => 'required',
            // 'country_id' => 'required|exists:list_countries,id',
            // 'studio_id' => 'required|exists:list_studios,id',
            // 'experience' => 'required|numeric',
            // 'information' => 'required|string',
            // 'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Please enter your first name.',
            'firstname.string' => 'First name must be a valid text.',
            'firstname.max' => 'First name cannot exceed 255 characters.',

            'lastname.required' => 'Please enter your last name.',
            'lastname.string' => 'Last name must be a valid text.',
            'lastname.max' => 'Last name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'Email already exists.',

            'mobile.required' => 'Contact no. is required.',
            'mobile.integer' => 'Invalid number.',
            'mobile.unique' => 'Number already exists.',

            'sex_id.required' => 'Sex is required.',

            // 'country_id.required' => 'Country is required.',
            // 'country_id.exists' => 'Invalid country.',


            // 'studio_id.required' => 'Please select a studio.',
            // 'studio_id.exists' => 'Selected studio is invalid.',

            // 'experience.required' => 'Please enter your years of experience.',
            // 'experience.numeric' => 'Experience must be a number.',

            // 'information.string' => 'Biography must be a valid text.',

            // 'password.required' => 'Please enter a password.',
            // 'password.string' => 'Password must be a valid text.',
            // 'password.min' => 'Password must be at least 8 characters long.',
            // 'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
