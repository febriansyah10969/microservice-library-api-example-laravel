<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Lowercase;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => [ 'required', 'email', 'max:255', 'unique:users,email', new Lowercase ],
            'category_id' => 'required|integer',
            'phone' => 'required|regex:/^\08[89]\d{8}$/',
            'date_of_birth' => 'date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Silakan isi nama terlebih dahulu.',
            'name.min' => 'Nama harus terdiri dari minimum 3 karakter',
            'email.required' => 'Silakan isi email terlebih dahulu',
            'email.email' => 'Silakan menggunakan format email yang valid',
            'email.unique' => 'Email sudah digunakan.',
            'category_id.required' => 'Silakan isi kategori id terlebih dahulu',
            'category.id.integer' => 'Kategori id harus integer',
            'phone.required' => 'Silakan masukan nomor telepon terlebih dahulu',
            'phone.regex' => 'Silahkan isi format no telepon seperti ini : 08******',
            'date_of_birth.date' => 'Silahkan isi format tanggal lahir seperti ini : 01-01-2000'
        ];
    }

}
