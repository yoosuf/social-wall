<?php


namespace App\Http\Controllers\Api\V1\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $request;

    private $model;

    public function __construct(Request $request, User $model)
    {
        $this->request = $request;

        $this->model = $model;
    }



    public function authenticate()
    {

        $this->validate($this->request, [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ]);

        $user = $this->model->email($this->request->get('email'))->first();

        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }




}
