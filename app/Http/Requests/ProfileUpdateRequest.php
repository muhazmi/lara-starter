<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => ['string', 'max:255'],
            'identity_card_number'  => ['nullable', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender'                => 'required',
            'email'                 => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone'                 => ['nullable', 'numeric', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address'               => 'nullable',
            'province_id'           => 'nullable',
            'city_id'               => 'nullable',
            'district_id'           => 'nullable',
            'village_id'            => 'nullable',
            'rt'                    => 'nullable',
            'rw'                    => 'nullable',
            'postcode'              => 'nullable',
            'profile_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Batasan file gambar
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                 => 'Nama harus diisi.',
            'identity_card_number.required' => 'NIK harus diisi.',
            'identity_card_number.unique'   => 'NIK sudah dipakai, silahkan ganti dengan yang lain.',
            'gender.required'               => 'Jenis Kelamin harus diisi.',
            'email.email'                   => 'Format email salah.',
            'email.unique'                  => 'Email sudah dipakai, silahkan ganti dengan yang lain.',
            'phone.required'                => 'No. HP harus diisi.',
            'phone.numeric'                 => 'No. HP diisi dengan angka saja.',
            'address.required'              => 'Alamat harus diisi.',
            'province_id.required'          => 'Provinsi harus diisi.',
            'city_id.required'              => 'Kabupaten/Kota harus diisi.',
            'district_id.required'          => 'Kecamatan harus diisi.',
            'village_id.required'           => 'Kelurahan / Desa harus diisi.',
            'password.min'                  => 'Password minimal 8 huruf.',
            'profile_image.max'             => 'Gambar tidak boleh > 2Mb.',
            'profile_image.image'           => 'File yang diupload hanya boleh berupa Gambar.',
            'profile_image.mimes'           => 'Jenis file yang boleh diupload hanya JPEG, JPG, dan PNG.',
        ];
    }
}
