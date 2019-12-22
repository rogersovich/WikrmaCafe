<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTableRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'table' => 'required',
            'floor_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'table.required' => 'Table harus di isi',
            'floor_id.required' => 'Lantai harus di pilih',
        ];
    }
}
