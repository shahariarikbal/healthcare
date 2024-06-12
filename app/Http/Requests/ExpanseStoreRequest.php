<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpanseStoreRequest extends FormRequest
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
            'expanse_date' => 'required',
            'amount' => 'required',
            'purpose' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'expanse_date.required' => 'Expanse date field is required',
            'amount.required' => 'Expanse amount field is required',
            'purpose.required' => 'Expanse purpose field is required'
        ];
    }
}
