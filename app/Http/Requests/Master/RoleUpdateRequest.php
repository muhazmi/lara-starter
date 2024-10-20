<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:roles,name,' . $this->role->id,
            'permission'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Nama Role harus diisi.',
            'name.unique'           => 'Nama Role sudah ada, silahkan ganti dengan yang lain.',
            'permission.required'   => 'Permission harus diisi.',
        ];
    }
}
