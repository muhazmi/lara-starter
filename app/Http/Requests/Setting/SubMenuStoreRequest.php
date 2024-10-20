<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->user()->hasRole('admin'); // Replace with your own logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'menu_id'   => 'required|integer',
            'name'      => 'required|max:255|unique:sub_menus',
            'url'       => 'required|string|max:255',
            'icon'      => 'required|string|max:100',
            'sort'      => 'required|unique:menus',
        ];
    }

    public function messages()
    {
        return [
            'sort.required'     => 'Nomor Urut harus diisi.',
            'sort.unique'       => 'Nomor Urut sudah ada, silahkan ganti dengan yang lain.',
            'menu_id.required'  => 'Nama Menu harus diisi.',
            'name.required'     => 'Nama Sub Menu harus diisi.',
            'name.unique'       => 'Nama Sub Menu sudah ada, silahkan ganti dengan yang lain.',
            'url.required'      => 'URL harus diisi.',
            'icon.required'     => 'Icon harus diisi.',
        ];
    }
}
