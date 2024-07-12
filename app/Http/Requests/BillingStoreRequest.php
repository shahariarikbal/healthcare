<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingStoreRequest extends FormRequest
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
            'fee' => 'required',
            'payment_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.required' => 'Doctor field is required',
            'doctor_id.integer' => 'Doctor field is must be type integer',
            'patient_id.required' => 'Patient field is required',
            'patient_id.integer' => 'Patient field is must be type integer',
            'appointment_date.required' => 'Appointment date is required',
            'payment_date.required' => 'Payment date field is required',
            'payment_type.required' => 'Payment type field is required',
            'fee.required' => 'Payable amount field is required'
        ];
    }
}
