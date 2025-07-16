<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemupukanRequest extends FormRequest
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
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date|before_or_equal:tomorrow',
            'jumlah_kg' => 'required|numeric|min:0',
            'jenis_pupuk' => 'required|string',
            'catatan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute harus diisi.',
            'before_or_equal' => ':attribute harus sebelum atau sama dengan tanggal hari ini.',
        ];
    }
}
