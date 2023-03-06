<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Lowercase;

class LoginRequest extends FormRequest
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
            'email' => [ 'required', 'email', 'max:255', 'exists:users,email', new Lowercase ],
            'pin' => 'required|digits:6|numeric|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Silakan isi email terlebih dahulu',
            'email.email' => 'Silakan menggunakan format email yang valid',
            'email.exists' => 'Email tidak ditemukan.',
            'pin.required' => 'Silakan isi pin terlebih dahulu',
            'pin.digits' => 'Pin harus terdiri dari 6 angka',
            'pin.regex' => 'Silakan isi pin dengan angka',
            'pin.numeric' => 'Silakan isi pin dengan angka'
        ];
    }

}
