<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceptionistStoreRequest extends FormRequest
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
            'first_name' => 'required|max:255|string',
            'email' => 'required|email|unique:receptionists,email',
            'password' => 'required|min:8',
            'dob' => 'required',
            'join_date' => 'required',
            'phone' => 'required|unique:receptionists,phone',
            'gender' => 'required|string',
            'address' => 'required',
            'qualification' => 'required|string',
            'experience' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'avatar' => 'required|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'The Email has already been taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least :min characters',
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'The phone number has already been taken',
            'gender.required' => 'Gender is required',
            'dob.required' => 'Date of birth field is required',
            'qualification.required' => 'Qualification is required',
            'qualification.string' => 'Qualification must be a string',
            'experience.required' => 'Experience is required',
            'experience.regex' => 'Experience must be a valid number with up to two decimal places',
            'address.required' => 'Address is required',
            'avatar.required' => 'Receptionist image is required',
            'avatar.max' => 'Receptionist image size must not exceed :max kilobytes'
        ];
    }
}
