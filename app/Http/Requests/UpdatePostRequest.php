<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::authorize('update', $this->route('post'))->allowed();

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
            'header_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // have to make nullabale in db
            'text' => 'required|string|between:100,1000',
            'rich_text' => 'nullable|json',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'published_at' => 'nullable|date',
        ];
    }
}
