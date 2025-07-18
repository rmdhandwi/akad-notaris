<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataBerkasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_jenis' => 'Jenis layanan',
            'id_kategori_pihak' => 'Kategori pihak',
            'nama_berkas' => 'Nama berkas',
        ];
    }

    public function rules(): array
    {
        return [
            'id_jenis' => ['required', 'exists:jenis_layanan,id_jenis'],
            'id_kategori_pihak' => ['required', 'exists:kategori_pihak,id_kategori_pihak'],
            'nama_berkas' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exists'   => ':attribute tidak terdaftar.',
        ];
    }
}
