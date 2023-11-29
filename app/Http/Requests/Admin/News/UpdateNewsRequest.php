<?php

namespace App\Http\Requests\Admin\News;

use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'id' => 'required|integer|exists:news,id',
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:png,jpg,webp,jpeg',
            'date' => 'required|date',
            'description' => 'required|string'
        ];
    }
}
