<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StafDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Staf',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'staf_details.staf_id' => 'ID Staf',
            'staf_details.nik_staf' => 'NIK staf',
            'staf_details.nama_staf' => 'Nama staf',
        ];
    }

    public function rules(): array
    {
        $staf_id = $this->input('staf_details.staf_id');
        $user_id = $this->input('user_id');

        $isUpdate = !empty($staf_id);

        $rules = [
            'user_id' => $isUpdate ? ['required', 'exists:users,user_id'] : ['nullable'],
            'staf_details.staf_id' => $isUpdate ? ['required', 'exists:staf_details,staf_id'] : ['nullable'],
            'username' => ['required', 'string'],
            'email' => [
                'required',
                'email:rfc',
                $isUpdate ?
                Rule::unique('users', 'email')->ignore($user_id, 'user_id') :
                Rule::unique('users', 'email'),
            ],
            'password' => [],
            'staf_details.nik_staf' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('staf_details', 'nik_staf')->ignore($staf_id, 'staf_id') :
                    Rule::unique('staf_details', 'nik_staf'),
            ],
            'staf_details.nama_staf' => [
                'required',
                'string',
                $isUpdate ?
                    Rule::unique('staf_details', 'nama_staf')->ignore($staf_id, 'staf_id') :
                    Rule::unique('staf_details', 'nama_staf'),
            ],
        ];

        if ($this->routeIs('admin.users.staf.store')) {
            $rules['password'] = ['required', 'string', 'min:6'];
        } elseif ($this->routeIs('admin.users.staf.update')) {
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
            'staf_details.*.min' => ':attribute minimal :min digit.',
            'staf_details.*.required' => ':attribute wajib diisi.',
            'staf_details.*.unique'   => ':attribute sudah terdaftar.',
            'staf_details.*.exists'   => ':attribute tidak terdaftar.',
        ];
    }
}
