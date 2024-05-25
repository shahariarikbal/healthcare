<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NurseStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:nurses,email',
            'dob' => 'required',
            'join_date' => 'required',
            'phone' => 'required|unique:nurses,phone',
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
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'The phone number has already been taken',
            'gender.required' => 'Gender is required',
            'dob.required' => 'Date of birth field is required',
            'qualification.required' => 'Qualification is required',
            'qualification.string' => 'Qualification must be a string',
            'experience.required' => 'Experience is required',
            'experience.regex' => 'Experience must be a valid number with up to two decimal places',
            'address.required' => 'Address is required',
            'avatar.required' => 'Nurse image is required',
            'avatar.max' => 'Nurse image size must not exceed :max kilobytes'
        ];
    }
}
