<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BerkasPihakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_jadwal' => 'Jadwal layanan',
            'id_jenis' => 'Jenis layanan',
            'berkas' => 'required|array',
            'berkas.*.*.id_pihak' => 'Pihak',
            'berkas.*.*.file' => 'File ',
            'berkas.*.*.id_berkas' => 'Jenis berkas',
            'berkas.*.*.nama_berkas' => 'Nama berkas',
        ];
    }

    public function rules(): array
    {
        return [
            'id_jenis' => 'required|exists:jenis_layanan,id_jenis',
            'id_permintaan' => 'required|exists:permintaan,id_permintaan',
            'berkas.*.*.id_pihak' => 'required|exists:data_pihak,id_pihak',
            'berkas.*.*.nama_berkas' => 'required|string|max:255',
            'berkas.*.*.file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exists'   => ':attribute tidak terdaftar.',
            'berkas.*.*.required' => ':attribute wajib diisi.',
            'berkas.*.*.exists'   => ':attribute tidak terdaftar.',
        ];
    }
}
