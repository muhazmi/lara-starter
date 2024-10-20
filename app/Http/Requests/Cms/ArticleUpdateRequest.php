<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'title'             => 'required|unique:articles,title,' . $this->article->id,
            'keywords'          => 'required|max:255',
            'meta_description'  => 'required|max:160',
            'description'       => 'required',
            'is_published'      => 'required',
            'published_at'      => 'nullable',
            'tag_id'            => 'nullable',
            'photo'             => 'nullable|mimes:jpeg,png,jpg,webp|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Judul Artikel harus diisi.',
            'keywords.required'         => 'Keywords harus diisi.',
            'description.required'      => 'Deskripsi harus diisi.',
            'meta_description.required' => 'Meta Deskripsi harus diisi.',
            'meta_description.max'      => 'Meta Deskripsi diisi maksimal 160 huruf/karakter saja.',
            'is_published.required'     => 'Status Publish harus diisi.',
            'photo.max'                 => 'Foto tidak boleh > 1 MB.',
            'photo.mimes'               => 'Format file yang boleh diupload hanya :mimes.',
        ];
    }
}
