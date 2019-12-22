<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMenuRequest extends FormRequest
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
            'jumlah' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jumlah.required' => 'Jumlah harus di isi'
        ];
    }
}
