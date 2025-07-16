<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotarisDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Notaris',
            'nomor_jabatan_notaris' => 'Nomor jabatan notaris',
            'nama_notaris' => 'Nama notaris',
        ];
    }

    public function rules(): array
    {
        $notaris_id = $this->input('notaris_id');

        $isUpdate = !empty($notaris_id);

        return [
            'user_id' => ['required', 'exists:users,user_id'],
            'nomor_jabatan_notaris' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('notaris_detail', 'nomor_jabatan_notaris')->ignore($notaris_id, 'notaris_id') :
                    Rule::unique('notaris_detail', 'nomor_jabatan_notaris'),
            ],
            'nama_notaris' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('notaris_detail', 'nama_notaris')->ignore($notaris_id, 'notaris_id') :
                    Rule::unique('notaris_detail', 'nama_notaris'),
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
