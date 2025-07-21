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
            'berkas.*.*.id_pihak' => 'Pihak',
            'berkas.*.*.file' => 'Berkas',
            'berkas.*.*.id_berkas' => 'Jenis berkas',
            'berkas.*.*.nama_berkas' => 'Nama berkas',
        ];
    }

    public function rules(): array
    {
        return [
            'id_jenis' => 'required|exists:jenis_layanan,id_jenis',
            'id_jadwal' => 'required|exists:data_jadwal,id_jadwal',
            'id_permintaan' => 'required|exists:permintaan_layanan,id_permintaan',
            'berkas' => 'required|array',
            'berkas.*' => 'required|array',
            'berkas.*.*.file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas.*.*.id_pihak' => 'required|exists:data_pihak,id_pihak',
            'berkas.*.*.id_berkas' => 'required|exists:data_berkas,id_berkas',
            'berkas.*.*.nama_berkas' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'id_jadwal.required' => ':attribute wajib dipilih.',
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exists'   => ':attribute tidak terdaftar.',
            'berkas.*.required' => ':attribute wajib diisi.',
            'berkas.*.*.required' => ':attribute wajib diisi.',
            'berkas.*.*.exists'   => ':attribute tidak terdaftar.',
            'berkas.*.*.file.required' => ':attribute wajib diupload.',
            'berkas.*.*.file.file' => ':attribute harus berupa file.',
            'berkas.*.*.file.mimes' => ':attribute harus berupa file bertipe: :values.',
            'berkas.*.*.file.max' => ':attribute maksimal berukuran :max kilobyte.',
        ];
    }
}
