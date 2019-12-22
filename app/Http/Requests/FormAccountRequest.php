<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama akun harus di isi',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Format harus email di isi',
            'role_id.required' => 'Role harus di pilih',
            'status.required' => 'Status harus di isi',
            'min.required' => 'password minimal harus 8 karakter'
        ];
    }
}
