<?php


namespace App\Http\Controllers\Api\V1\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $request;

    private $model;

    public function __construct(Request $request, User $model)
    {
        $this->request = $request;

        $this->model = $model;
    }


    public function createUser()
    {
        $this->validate($this->request, [
            'full_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required']
        ]);

        $data = [
            'full_name' => $this->request->get('full_name'),
            'email' => $this->request->get('email'),
            'password' => Hash::make($this->request->get('password')),
        ];

        $user = $this->model->create($data);

        return response()->json([
            'token' => $this->jwt($user)
        ], 200);
    }

}
