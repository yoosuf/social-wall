<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Firebase\JWT\JWT;

class Controller extends BaseController
{


    /**
     * @param $data
     * @return mixed
     */
    protected function jwt($data) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $data->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
}
