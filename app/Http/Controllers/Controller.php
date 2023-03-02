<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helper;

    protected function successResponse($status, $message, $data, $errors)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta' => [], 
            'data' => $data,
            'error' => $errors,
        ], 200);
    }

    protected function paginationResponse($status, $message, $data, $items, $errors)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta' => [
                "next_cursor" => $data->nextPageUrl(),
                "perpage" => (int) $data->perPage(),
                "prev_cursor" => $data->previousPageUrl(),
                "has_more_pages" => true
            ], 
            'data' => $items,
            'error' => [],
        ], 200);
    }

}
