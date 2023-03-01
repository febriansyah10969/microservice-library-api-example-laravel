<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // * create new users.
        \DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'category_id' => $request->category_id,
            'email' => Str::lower($request->email),
            'pin' => Hash::make($request->pin),
            'phone' => $this->validatePhoneNumber($request->phone),
            'date_of_birth' => $request->date_of_birth
        ]);

        return $this->successResponse(true, 'Berhasil Mendaftar.', [], []);
    }


    function validatePhoneNumber($phone) {           
        if (substr(trim($phone), 0, 2) == '62'){
            // cek apakah no hp karakter 1-2 adalah 62
            $phone = '0'.substr(trim($phone), 2);
        } else if (substr(trim($phone), 0, 3) == '+62'){
            // cek apakah no hp karakter 1-3 adalah +62
            $phone = '0'.substr(trim($phone), 3);
        } else if (substr(trim($phone), 0, 1) == '0'){
            // cek apakah no hp karakter 1 adalah 0
            $phone = trim($phone);
        } else {
            return '';
        }
        return $phone;
    }
}
