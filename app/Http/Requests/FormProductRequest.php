<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormProductRequest extends FormRequest
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
            'menu_category_id' => 'required',
            'name' => 'required',
            'stok' => 'required|numeric|integer',
            'purchase_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'picture' => 'image|mimes:jpg,jpeg,png|max:2048',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'menu_category_id.required' => 'Kategori harus di pilih',
            'name.required' => 'Nama Produk harus di isi',
            'stok.required' => 'Stok harus di isi',
            'stok.numeric' => 'Stok harus Angka',
            'stok.integer' => 'Stok tidak boleh decimal',
            'purchase_price.required' => 'Harga Beli harus di isi',
            'purchase_price.numeric' => 'Harga Beli harus angka',
            'sell_price.required' => 'Harga Jual harus di isi',
            'sell_price.numeric' => 'Harga Jual harus angka',
            'picture.required' => 'Foto harus di pilih',
            'time.required' => 'waktu harus di pilihs',
        ];
    }
}
