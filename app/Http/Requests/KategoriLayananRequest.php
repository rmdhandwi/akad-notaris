<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'nama_kategori' => 'Nama kategori',
            'deskripsi_kategori' => 'Deskripsi kategori',
        ];
    }

    public function rules(): array
    {
        $id_kategori = $this->input('id_kategori');

        $isUpdate = !empty($id_kategori);

        return [
            'nama_kategori' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('kategori_layanan', 'nama_kategori')->ignore($id_kategori, 'id_kategori') :
                    Rule::unique('kategori_layanan', 'nama_kategori'),
            ],
            'deskripsi_kategori' => [
                'nullable',
                'string',
                $isUpdate ?
                    Rule::unique('kategori_layanan', 'deskripsi_kategori')->ignore($id_kategori, 'id_kategori') :
                    Rule::unique('kategori_layanan', 'deskripsi_kategori'),
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
