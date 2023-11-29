<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'id' => 'required|integer|exists:countries,id',
            'name' => 'required|string|max:255|unique:countries,name,' . request('id'),
            'iso' => 'required|string|unique:countries,iso,' . request('id'),
            'code' => 'required|regex:/[\d\-]+/'
        ];
    }
}
