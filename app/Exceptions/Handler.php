<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {

        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        
        
        if ($exception instanceof HttpResponseException) {
            if (env('APP_DEBUG')) return response()->json([
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode(),
            ], $code);
        } elseif ($exception instanceof ValidationException) {
            $errorBag = [];
            foreach($exception->errors() as $key => $value) $errorBag[] = [ 'attribute' => $key, 'text' => $value[0]];
            return response()->json([
                'status'  => false,
                'message' => $exception->getMessage(),
                'data'    => (object)[],
                'meta'    => (object)[],
                'error'   => $errorBag
            ], Response::HTTP_OK);
        } else {
            // if (env('APP_DEBUG')) {
                return response()->json([
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                ], $code);
            // } 
        }

        return parent::render($request, $exception);
    }
}
