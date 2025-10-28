<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'name' => 'required|string|between:20,255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text' => 'required|string|between:100,300',
            'rich_text' => 'nullable|json',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'published_at' => 'nullable|date',
        ];
    }
}
