<?php

namespace App\Http\Requests\Admin\ClinicPhone;

use App\Models\ClinicPhone;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicPhoneRequest extends FormRequest
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
        return array_merge(ClinicPhone::createRule(), [
            'id' => 'required|integer|exists:clinic_phones,id'
        ]);
    }
}
