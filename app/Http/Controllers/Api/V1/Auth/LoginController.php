<?php


namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $request;

    private $model;

    public function __construct(Request $request, User $model)
    {
        $this->middleware('auth', ['except' => 'authenticate']);

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
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }


    public function refreshToken()
    {
        $user = $this->request->auth;

        return response()->json([
            'refresh_token' => $this->jwt($user)
        ], 200);
    }




}
