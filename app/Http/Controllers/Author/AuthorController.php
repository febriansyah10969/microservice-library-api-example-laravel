<?php

namespace App\Http\Controllers\Author;

use App\Http\Resources\Author\AuthorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Author\CreateAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\User;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        return $this->successResponse(true, 'Berhasil Mendapatkan data.', AuthorResource::collection(\DB::table('authors')->orderBy('id', 'desc')->get()), []);
    }

    public function getListWithPagination(Request $request)
    {
        $data = \DB::table('authors')->orderBy('id', 'desc')->paginate($request->query('perPage'));

        return $this->paginationResponse(true, 'Berhasil mendapatkan data.', $data, AuthorResource::collection($data->items()), []);
    }

    public function create(CreateAuthorRequest $request)
    {
        \DB::table('authors')->insert([
            'uuid' => Str::uuid(),
            'name' => $request->name,
        ]);

        return $this->successResponse(true, 'Berhasil merubah Author', [], []);
    }

    public function update(UpdateAuthorRequest $request, $uuid)
    {
        \DB::table('authors')->where('uuid', $uuid)->update([
            'name' => $request->name,
        ]);

        return $this->successResponse(true, 'Berhasil menambahkan Author', [], []);
    }
}