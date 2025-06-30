<?php

namespace App\Http\Requests\Album;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'stocks' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
            'category_id' => 'required|integer|exists:categories,id',
            'cover' => 'required|image',
        ];
    }
}
