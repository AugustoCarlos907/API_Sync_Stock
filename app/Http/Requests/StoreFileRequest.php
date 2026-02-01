<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'file' => 'required|file|mimes:csv|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'A file is required.',
            'file.file' => 'The uploaded item must be a file.',
            'file.mimes' => 'The file must be a type of: csv, txt.',
            'file.max' => 'The file size must not exceed 2MB.',
        ];
    }
}
