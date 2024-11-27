<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailsRequest extends FormRequest
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
            'street' => 'required|max:25',
            'city' => 'required|max:25',
            'country' => 'required|max:25',
            'postal_code' => 'required|numeric',
            'title' => 'required',
            'biography' => 'required|max:1000',
            'file_path' => 'required|max:2048',
        ];
    }
}
