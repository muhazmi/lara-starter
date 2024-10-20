<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'                  => 'required|max:255',
            'director_name'         => 'required|max:255',
            'short_description'     => 'required|max:255',
            'description'           => 'required',
            'email'                 => 'nullable|email|max:255',
            'telephone'             => 'nullable|numeric|max_digits:15',
            'phone'                 => 'nullable|numeric|max_digits:15',
            'address'               => 'required',
            'facebook_link'         => 'nullable|url',
            'instagram_link'        => 'nullable|url',
            'twitter_link'          => 'nullable|url',
            'gmap_link'             => 'nullable|url',
            'gmap_location'         => 'nullable',
            'logo'                  => 'nullable|mimes:jpeg,png,jpg,webp,pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'Nama Perusahaan harus diisi',
            'director_name.required'        => 'Nama Direktur / Owner harus diisi',
            'short_description.required'    => 'Deskripsi Singkat Perusahaan harus diisi',
            'description.required'          => 'Deskripsi Perusahaan harus diisi',
            'email.email'                   => 'Format email salah',
            'telephone.numeric'             => 'Telepon diisi dengan angka saja',
            'facebook_link.url'             => 'Link Facebook keliru',
            'instagram_link.url'            => 'Link Instagram keliru',
            'twitter_link.url'              => 'Link Twitter keliru',
            'gmap_link.url'                 => 'Link Google Map keliru',
        ];
    }
}
