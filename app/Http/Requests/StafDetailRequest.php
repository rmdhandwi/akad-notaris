<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DatastafRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Staf',
            'nik_staf' => 'NIK staf',
            'nama_staf' => 'Nama staf',
        ];
    }

    public function rules(): array
    {
        $staf_id = $this->input('staf_id');

        $isUpdate = !empty($staf_id);

        return [
            'user_id' => ['required', 'exists:users,user_id'],
            'nik_staf' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('staf_detail', 'nik_staf')->ignore($staf_id, 'staf_id') :
                    Rule::unique('staf_detail', 'nik_staf'),
            ],
            'nama_staf' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('staf_detail', 'nama_staf')->ignore($staf_id, 'staf_id') :
                    Rule::unique('staf_detail', 'nama_staf'),
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
