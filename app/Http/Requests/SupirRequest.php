<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupirRequest extends FormRequest
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
            'nama' => 'required|string',
            'no_hp' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
            'string' => ':attribute harus berupa string.',
        ];
    }
}
