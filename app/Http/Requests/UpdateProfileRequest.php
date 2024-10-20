<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|min:3|max:100',
            'identity_card_number'  => ['nullable', 'min:16', 'max:16', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender'                => 'nullable',
            'email'                 => ['email', Rule::unique(User::class)->ignore($this->user()->id)],
            'mobile_phone'          => ['nullable', 'numeric', Rule::unique(User::class)->ignore($this->user()->id)],
            'address'               => 'nullable',
            'province_id'           => 'nullable',
            'city_id'               => 'nullable',
            'district_id'           => 'nullable',
            'village_id'            => 'nullable',
            'rt'                    => 'nullable',
            'rw'                    => 'nullable',
            'postcode'              => 'nullable',
            'profile_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Batasan file gambar
            'current_password'      => 'nullable|required_with:new_password|current_password',
            'new_password'          => 'nullable|string|min:8|confirmed',
            'email_verified_at'     => 'nullable',
        ];
    }
}
