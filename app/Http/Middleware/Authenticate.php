<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\UserCustomer;

class Authenticate extends Middleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($guards[0] == 'api') {
            if ($this->auth->guard($guards[0])->guest()) {
                return response()->json([
                    'code' => 401,
                    'status' => false,
                    'message' => 'Unauthorized',
                    'data' => (object) [],
                    'meta' => (object) [],
                    'error' => (object) [],
                ], 401);
            }
        }

        return $next($request);
    }
}
