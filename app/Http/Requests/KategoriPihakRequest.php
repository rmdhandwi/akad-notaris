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
            'nama_kategori_pihak' => 'Nama kategori Pihak',
        ];
    }

    public function rules(): array
    {
        $id_kategori_pihak = $this->input('id_kategori_pihak');

        $isUpdate = !empty($id_kategori_pihak);

        return [
            'id_kategori_pihak' => [
                $isUpdate ? ['required','exists:kategori_pihak,id_kategori_pihak'] : ['nullable']
            ],
            'nama_kategori_pihak' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('kategori_pihak', 'nama_kategori')->ignore($id_kategori_pihak, 'id_kategori_pihak') :
                    Rule::unique('kategori_pihak', 'nama_kategori'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
        ];
    }
}
