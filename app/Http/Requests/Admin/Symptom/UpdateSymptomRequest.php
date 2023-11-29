<?php

namespace App\Http\Requests\Admin\Symptom;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSymptomRequest extends FormRequest
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
            'id' => 'required|integer|exists:symptoms,id',
            'symptom' => 'required|string|max:255|unique:symptoms,symptom,' . request('id')
        ];
    }
}
