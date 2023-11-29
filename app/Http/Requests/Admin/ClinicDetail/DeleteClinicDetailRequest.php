<?php

namespace App\Http\Requests\Admin\ClinicDetail;

use App\Models\ClinicDetail;
use Illuminate\Foundation\Http\FormRequest;

class DeleteClinicDetailRequest extends FormRequest
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
            'id' => 'required|integer|exists:clinic_details,id'
        ];
    }
}
