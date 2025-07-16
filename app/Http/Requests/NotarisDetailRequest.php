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
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'notaris_details.notaris_id' => 'ID notaris',
            'notaris_details.nomor_jabatan_notaris' => 'Nomor Jabatan notaris',
            'notaris_details.nama_notaris' => 'Nama notaris',
        ];
    }

    public function rules(): array
    {
        $notaris_id = $this->input('notaris_details.notaris_id');

        $isUpdate = !empty($notaris_id);

        $rules = [
            'user_id' => $isUpdate ? ['required', 'exists:users,user_id'] : ['nullable'],
            'notaris_details.notaris_id' => $isUpdate ? ['required', 'exists:notaris_details,notaris_id'] : ['nullable'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => [],
            'notaris_details.nomor_jabatan_notaris' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('notaris_details', 'nomor_jabatan_notaris')->ignore($notaris_id, 'notaris_id') :
                    Rule::unique('notaris_details', 'nomor_jabatan_notaris'),
            ],
            'notaris_details.nama_notaris' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('notaris_details', 'nama_notaris')->ignore($notaris_id, 'notaris_id') :
                    Rule::unique('notaris_details', 'nama_notaris'),
            ],
        ];

        if ($this->routeIs('admin.users.notaris.store')) {
            $rules['password'] = ['required', 'string', 'min:6'];
        } elseif ($this->routeIs('admin.users.notaris.update')) {
            $rules['password'] = ['nullable', 'string', 'min:6'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.min' => ':attribute minimal :min digit.',
            '*.required' => ':attribute wajib diisi.',
            '*.unique'   => ':attribute sudah terdaftar.',
            '*.exists'   => ':attribute tidak terdaftar.',
            'notaris_details.*.min' => ':attribute minimal :min digit.',
            'notaris_details.*.required' => ':attribute wajib diisi.',
            'notaris_details.*.unique'   => ':attribute sudah terdaftar.',
            'notaris_details.*.exists'   => ':attribute tidak terdaftar.',
        ];
    }
}
