<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|unique:patients,phone',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Patient name is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'The Email has already been taken',
            'phone.required' => 'Phone field is required',
            'phone.unique' => 'The phone has already been taken',
            'address.required' => 'Address field is required'
        ];
    }
}
