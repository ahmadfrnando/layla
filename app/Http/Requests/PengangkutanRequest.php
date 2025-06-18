<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengangkutanRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'nama_supir' => 'required|string',
            'kendaraan_pengangkutan' => 'required|in:truk,motor',
            'nomor_polisi' => 'required|string',
            'keterangan' => 'nullable|string',
            'blok' => 'required|string',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode_pengangkutan.unique' => 'Kode pengangkutan ini sudah digunakan',
        ];
    }
}
