<?php

namespace App\Http\Requests\EndUser\Contact;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required|string'
        ];
    }
}
