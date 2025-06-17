<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengangkutanHasilPanenRequest extends FormRequest
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
            'pengangkutan_id' => 'required|integer',
            'tanggal' => 'required|date',
            'muatan_afdeling' => 'nullable|numeric|min:0',
            'tandan_afdeling' => 'nullable|numeric|min:0',
            'muatan_pabrik' => 'nullable|numeric|min:0',
            'tandan_pabrik' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'pengangkutan_id.required' => 'ID Pengangkutan harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'muatan_afdeling.required' => 'Muatan Afdeling harus diisi.',
            'muatan_afdeling.numeric' => 'Muatan Afdeling harus berupa angka.',
            'tandan_afdeling.numeric' => 'Tandan Afdeling harus berupa angka.',
            // dan seterusnya untuk kolom lainnya
        ];
    }
}
