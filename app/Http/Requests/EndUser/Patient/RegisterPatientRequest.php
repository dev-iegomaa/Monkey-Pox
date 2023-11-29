<?php

namespace App\Http\Requests\EndUser\Patient;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|alpha|max:255',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|confirmed',
            'country_id' => 'required|integer|exists:countries,id'
        ];
    }
}
