<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
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
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'appointment_date' => 'required',
            'problem' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.required' => 'Doctor field is required',
            'doctor_id.required' => 'Doctor field is must be type integer',
            'patient_id.required' => 'Patient field is required',
            'patient_id.required' => 'Patient field is must be type integer',
            'appointment_date.required' => 'Appointment date is required',
            'problem.required' => 'Diseased field is required'
        ];
    }
}
