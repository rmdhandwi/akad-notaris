<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class berkasLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_jenis' => 'Jenis layanan',
            'nama_berkas' => 'Nama berkas',
        ];
    }

    public function rules(): array
    {
        $id_berkas = $this->input('id_berkas');

        $isUpdate = !empty($id_berkas);

        return [
            'id_jenis' => $isUpdate ? ['required', 'exists:jenis_layanan,id_jenis'] : 'nullable',
            'nama_berkas' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('data_berkas', 'nama_berkas')->ignore($id_berkas, 'id_berkas') :
                    Rule::unique('data_berkas', 'nama_berkas'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exist'   => ':attribute tidak terdaftar.',
        ];
    }
}
