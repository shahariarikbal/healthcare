<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
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
            'department_id' => 'required|integer',
            'first_name' => 'required|max:255|string',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:8',
            'phone' => 'required|unique:doctors,phone',
            'gender' => 'required',
            'fee' => 'required|integer',
            'qualification' => 'required|string',
            'experience' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'], // Check if value is a float,
            'address' => 'required',
            'avatar' => 'required|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'Department name is required',
            'first_name.required' => 'First name is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'The Email has already been taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least :min characters',
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'The phone number has already been taken',
            'gender.required' => 'Gender is required',
            'fee.required' => 'Doctor Fee is required',
            'fee.integer' => 'Doctor Fee must be an integer',
            'qualification.required' => 'Qualification is required',
            'qualification.string' => 'Qualification must be a string',
            'experience.required' => 'Experience is required',
            'experience.regex' => 'Experience must be a valid number with up to two decimal places',
            'address.required' => 'Address is required',
            'avatar.required' => 'Doctor image is required',
            'avatar.max' => 'Doctor image size must not exceed :max kilobytes'
        ];
    }

}
