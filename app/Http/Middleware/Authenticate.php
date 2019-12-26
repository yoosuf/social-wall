<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Authenticate
{

    protected $request;

    protected $model;

    /**
     * Create a new middleware instance.
     *
     * @param Request $request
     * @param User $model
     */
    public function __construct(Request $request, User $model)
    {
        $this->request = $request;

        $this->model = $model;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $this->bearerToken();

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
        $user = User::find($credentials->sub);
        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;

        return $next($request);
    }



    private function bearerToken()
    {
        $header = $this->request->header('Authorization');

        if (Str::startsWith($header, 'Bearer '))
            return Str::substr($header, 7);

    }

}
