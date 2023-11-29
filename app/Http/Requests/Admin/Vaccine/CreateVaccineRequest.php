<?php

namespace App\Http\Requests\Admin\Vaccine;

use Illuminate\Foundation\Http\FormRequest;

class CreateVaccineRequest extends FormRequest
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
            'vaccine' => 'required|string|max:255|unique:vaccines,vaccine'
        ];
    }
}
