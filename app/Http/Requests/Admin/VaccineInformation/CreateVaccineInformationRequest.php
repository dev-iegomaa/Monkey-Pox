<?php

namespace App\Http\Requests\Admin\VaccineInformation;

use App\Models\VaccineInformation;
use Illuminate\Foundation\Http\FormRequest;

class CreateVaccineInformationRequest extends FormRequest
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
        return VaccineInformation::createRule();
    }
}
