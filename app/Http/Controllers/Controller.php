<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\Helper;

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

}
