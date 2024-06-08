<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmtpConfigRequest extends FormRequest
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
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|string',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'mail_mailer.required' => 'Driver field is required',
            'mail_mailer.string' => 'Driver field is string',
            'mail_host.required' => 'Host field is required',
            'mail_host.string' => 'Host field is string',
            'mail_port.required' => 'Port field is required',
            'mail_port.string' => 'Port field is string',
            'mail_username.required' => 'Username field is required',
            'mail_username.string' => 'Username field is string',
            'mail_password.required' => 'Password field is required',
            'mail_password.string' => 'Password field is string',
            'mail_encryption.string' => 'Encryption field is string',
            'mail_from_address.required' => 'Mail From Address field is required',
            'mail_from_address.required' => 'Please provide valid email address',
            'mail_from_name.required' => 'Mail From Name field is required',
            'mail_from_name.string' => 'Mail From Name field is string'
        ];
    }
}
