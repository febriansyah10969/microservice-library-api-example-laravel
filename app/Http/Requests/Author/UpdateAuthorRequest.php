<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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

    protected function prepareForValidation() 
    {
        $this->merge(['uuid' => $this->route('uuid')]);
    }

    public function rules()
    {
        return [
            'uuid' => 'exists:authors,uuid',
            'name' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'uuid.exists' => 'author tidak ditemukan.',
            'name.required' => 'Silakan isi email terlebih dahulu',
            'name.min' => 'Silakan menggunakan format email yang valid',
        ];
    }
}
