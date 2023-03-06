<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $getUser = User::where('email', $request->email)->first();

        $check = Hash::check($request->pin, $getUser->pin);
        if ($check) {
            $generateToken = $getUser->createToken('access_token')->accessToken;

            return $this->successResponse(true, 'Berhasil Login.', ['access_token' => $generateToken], []);
        }

        return $this->successResponse(false, 'Email atau pin salah.', [], []);
    }
}
