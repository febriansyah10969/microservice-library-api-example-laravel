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
        $prev = $data->previousPageUrl();
        $next = $data->nextPageUrl();
        
        $prevCursor = null;
        $nextCursor = null;

        if (isset($prev) && !empty($prev)) {
            parse_str(parse_url($prev, PHP_URL_QUERY), $prevCursor);
            $prevCursor = $prevCursor['cursor'];
        }

        if (isset($next) && !empty($next)) {
            parse_str(parse_url($next, PHP_URL_QUERY), $nextCursor);
            $nextCursor = $nextCursor['cursor'];
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta' => [
                "next_cursor" => $nextCursor,
                "perpage" => (int) $data->perPage(),
                "prev_cursor" => $prevCursor,
                "has_more_pages" => $data->hasMorePages()
            ], 
            'data' => $items,
            'error' => [],
        ], 200);
    }

}
