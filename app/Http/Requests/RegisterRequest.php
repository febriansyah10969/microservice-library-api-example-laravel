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
            'category_id' => 'required|integer|exists:categories,id',
            'phone' => ['required', 'regex:/^08(1[1-9]|2[1-2]|5[2-8]|7[1-9]|8[1-9]|9[1-9])\d{7,9}$/'],
            'date_of_birth' => 'date_format:Y-m-d',
            'pin' => 'required|digits:6|numeric|regex:/^[0-9]+$/',
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
            'category_id.integer' => 'Kategori id harus integer',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'phone.required' => 'Silakan masukan nomor telepon terlebih dahulu',
            'phone.regex' => 'Silahkan masukan nomor telephon 11-13 digit dengan format : 08******',
            'date_of_birth.date_format' => 'Silahkan isi format tanggal lahir seperti ini : 2000-01-14',
            'pin.required' => 'Silakan isi pin terlebih dahulu',
            'pin.digits' => 'Pin harus terdiri dari 6 angka',
            'pin.regex' => 'Silakan isi pin dengan angka',
            'pin.numeric' => 'Silakan isi pin dengan angka'
        ];
    }

}
