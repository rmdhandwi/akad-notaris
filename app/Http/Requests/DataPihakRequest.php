<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataPihakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'id_jenis' => 'Jenis layanan',
            'pihak.*.id_kategori_pihak' => 'Kategori pihak',
            'pihak.*.nama_pihak' => 'Nama pihak',
            'pihak.*.no_hp_pihak' => 'Nomor HP pihak',
            'pihak.*.nik_pihak' => 'NIK pihak',
            'pihak.*.alamat_pihak' => 'Alamat pihak',
            'pihak.*.tipe_pihak' => 'Tipe pihak',
        ];
    }

    public function rules(): array
    {
        return [
            'id_jenis_layanan' => 'required|exists:jenis_layanan,id_jenis',
            'pihak' => 'required|array|min:1',
            'pihak.*.user_id' => 'nullable|exists:users,user_id',
            'pihak.*.nama_pihak' => 'required|string|max:255',
            'pihak.*.id_kategori_pihak' => 'required|exists:kategori_pihak,id_kategori_pihak',
            'pihak.*.no_hp_pihak' => 'required|string|max:50',
            'pihak.*.nik_pihak' => 'required|string|max:50',
            'pihak.*.alamat_pihak' => 'required|string|max:255',
            'pihak.*.tipe_pihak' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exists'   => ':attribute tidak terdaftar.',
            'pihak.*.required' => ':attribute wajib diisi.',
            'pihak.*.exists'   => ':attribute tidak terdaftar.',
        ];
    }
}
