<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JenisLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_kategori' => 'Kategori',
            'nama_jenis' => 'Nama jenis',
            'deskripsi_jenis' => 'Deskripsi jenis',
        ];
    }

    public function rules(): array
    {
        $id_jenis = $this->input('id_jenis');

        $isUpdate = !empty($id_jenis);

        return [
            'id_kategori' => $isUpdate ? ['required', 'exists:kategori_layanan,id_kategori'] : 'nullable',
            'nama_jenis' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('jenis_layanan', 'nama_jenis')->ignore($id_jenis, 'id_jenis') :
                    Rule::unique('jenis_layanan', 'nama_jenis'),
            ],
            'deskripsi_jenis' => [
                'nullable',
                'string',
                $isUpdate ?
                    Rule::unique('jenis_layanan', 'deskripsi_jenis')->ignore($id_jenis, 'id_jenis') :
                    Rule::unique('jenis_layanan', 'deskripsi_jenis'),
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
