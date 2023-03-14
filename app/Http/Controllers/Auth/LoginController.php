<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $getUser = User::where('email', $request->email)->first();

        $check = Hash::check($request->pin, $getUser->pin);
        if ($getUser && $check) {
            JWTAuth::factory()->setTTL(600);
            $generateToken = Auth::guard('api')->fromUser($getUser, ENV('JWT_SECRET'));
            return $this->successResponse(true, 'Berhasil Login.', [
                'access_token' => $generateToken,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ], []);
        }

        return $this->successResponse(false, 'Email atau pin salah.', [], []);
    }
}
