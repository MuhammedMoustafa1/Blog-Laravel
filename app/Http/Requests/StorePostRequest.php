<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255', //or pass as array
            'body' => 'required|min:2',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'You must enter a title',
            'title.unique' => 'This title is already taken',

            'body.required' => 'You must enter a body',
            'body.min' => 'The body must be at least 2 characters',
        ];

}
}
