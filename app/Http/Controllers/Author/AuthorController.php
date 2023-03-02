<?php

namespace App\Http\Controllers\Author;

use App\Http\Resources\Author\AuthorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Author\CreateAuthorRequest;
use App\User;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        return $this->successResponse(true, 'Berhasil Login.', AuthorResource::collection(\DB::table('authors')->orderBy('id', 'desc')->get()), []);
    }

    public function create(CreateAuthorRequest $request)
    {
        \DB::table('authors')->insert([
            'uuid' => Str::uuid(),
            'name' => $request->name,
        ]);

        return $this->successResponse(true, 'Berhasil menambahkan Author', [], []);
    }
}