<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['exists:categories,id'],
            'image' => ['required', 'array'],
            'image.*' => ['required', 'file'],
            'sale' => ['required', 'integer'],
            'price' => ['nullable', 'integer'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }
}
