<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the role is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'Nama harus diisi.',
        ];
    }
}
