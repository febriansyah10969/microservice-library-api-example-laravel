<?php

namespace App\Http\Controllers\Profile;

use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $this->successResponse(true, 'Berhasil Login.', new ProfileResource($request->user()), []);
    }
}
