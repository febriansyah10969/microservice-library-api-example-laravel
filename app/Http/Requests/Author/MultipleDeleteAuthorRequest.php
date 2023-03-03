<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class MultipleDeleteAuthorRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid.*' => 'exists:authors,uuid',
        ];
    }

    public function messages()
    {
        return [
            'uuid.*.exists' => 'Author tidak ditemukan.',
        ];
    }
}
