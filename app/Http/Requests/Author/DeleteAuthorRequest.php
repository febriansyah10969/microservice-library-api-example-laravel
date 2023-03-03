<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAuthorRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'exists:users,uuid',
        ];
    }

    public function messages()
    {
        return [
            'uuid.exists' => 'Author tidak ditemukan.',
        ];
    }
}
