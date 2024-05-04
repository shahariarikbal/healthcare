<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:doctors,email,'.$this->id,
            'password' => 'sometimes|min:8',
            'phone' => 'required|unique:doctors,phone,'.$this->id,
            'gender' => 'required',
            'fee' => 'required|integer',
            'qualification' => 'required|string',
            'experience' => 'required',
            'address' => 'required',
            'avatar' => 'sometimes|max:2048'
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
            'fee.required' => 'Fee is required',
            'fee.integer' => 'Fee must be an integer',
            'qualification.required' => 'Qualification is required',
            'qualification.string' => 'Qualification must be a string',
            'experience.required' => 'Experience is required',
            'address.required' => 'Address is required',
            'avatar.max' => 'Avatar size must not exceed :max kilobytes'
        ];
    }
}
