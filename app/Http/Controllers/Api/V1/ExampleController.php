<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $headerToken = $request->header('authorization');

        $token = Str::substr($headerToken, 7);

        $decoded = JWT::decode($token, env('JWT_SECRET'), ['HS256']);

        return dd($decoded);
    }
}
