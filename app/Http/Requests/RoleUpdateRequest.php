<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the role is authorized to make this request.
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
            'name' => 'required|max:100|unique:roles,name,' . $this->role->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.unique'   => 'Nama sudah dipakai, silahkan ganti dengan yang lain.',
        ];
    }

}
