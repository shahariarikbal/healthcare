<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionStoreRequest extends FormRequest
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
            'patient_id' => 'required|integer',
            'gender' => 'required|string',
            'age' => 'required',
            'medicine_name.*' => 'required',
            'dose.*' => 'required',
            'duration.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Field is required',
            'gender.required' => 'Field is required',
            'age.required' => 'Field is required',
            'medicine_name.*' => 'Field is required',
            'dose.*' => 'Field is required',
            'duration.*' => 'Required',
        ];
    }
}
