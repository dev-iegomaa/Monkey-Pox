<?php

namespace App\Http\Requests\Admin\Doctor;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'id' => 'required|integer|exists:doctors,id',
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:doctors,email,' . request('id'),
            'image' => 'image|mimes:png,jpg,webp,jpeg',
            'highest_certificate' => 'string|max:255|in:msc,md,diploma,mbbch',
            'country_id' => 'integer|exists:countries,id',
            'description' => 'string'
        ];
    }
}
