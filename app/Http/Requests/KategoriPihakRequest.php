<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriPihakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_kategori_pihak' => 'ID kategori pihak',
            'id_jenis' => 'Jenis layanan',
            'nama_kategori_pihak' => 'Nama kategori Pihak',
        ];
    }

    public function rules(): array
    {
        $id_kategori_pihak = $this->input('id_kategori_pihak');

        $isUpdate = !empty($id_kategori_pihak);

        return [
            'id_kategori_pihak' =>
                $isUpdate ? ['required','exists:kategori_pihak,id_kategori_pihak'] : ['nullable']
            ,
            'id_jenis' => [
                'required', 'exists:jenis_layanan,id_jenis',
            ],
            'nama_kategori_pihak' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.exist' => ':attribute tidak terdaftar.',
            '*.unique'   => ':attribute sudah terdaftar.',
        ];
    }
}
