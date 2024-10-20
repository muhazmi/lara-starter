<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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
            'name'  => 'required|max:255|unique:menus',
            'url'   => 'required|string|max:255',
            'icon'  => 'required|string|max:20',
            'sort'  => 'required|unique:menus',
        ];
    }

    public function messages()
    {
        return [
            'sort.required'         => 'Nomor Urut harus diisi.',
            'sort.unique'           => 'Nomor Urut sudah ada, silahkan ganti dengan yang lain.',
            'name.required'         => 'Nama Menu harus diisi.',
            'name.unique'           => 'Nama Menu sudah ada, silahkan ganti dengan yang lain.',
            'url.required'          => 'URL harus diisi.',
            'icon.required'         => 'Icon harus diisi.',
        ];
    }
}
