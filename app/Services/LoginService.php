<?php

namespace App\Services;


use App\Services\ApiHandler;
use App\Services\Implemen\LoginServiceImpl;


class LoginService implements LoginServiceImpl{

    public function login($user, $password)
    {
        return ApiHandler::requestWithoutAccessToken("POST","/api/login",[
            "email" => $user,
            "password" => $password
        ]);
    }
}
