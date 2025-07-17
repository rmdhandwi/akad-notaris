<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataJadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tanggal' => Carbon::parse($this->tanggal)->timezone('Asia/Jayapura')->format('Y-m-d'),
        ]);
    }

    public function attributes(): array
    {
        return [
            'id_jadwal' => 'Jadwal',
            'tanggal' => 'Tanggal',
            'waktu_mulai' => 'Waktu mulai',
            'waktu_selesai' => 'Waktu selesai',
            'alasan' => 'Alasan / Kendala',
        ];
    }

    public function rules(): array
    {
        return [
            'tanggal' => [
                'required',
                'date',
            ],
            'waktu_mulai' => [
                'required',
                'date_format:H:i',
            ],
            'waktu_selesai' => [
                'required',
                'date_format:H:i',
                'after:waktu_mulai',
            ],
            'alasan' =>
            [
                'nullable',
                'string',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.date'   => ':attribute harus format tanggal.',
            '*.date_format'   => ':attribute harus format :date_format.',
        ];
    }
}
