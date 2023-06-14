<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\ApiAuth\ApiAuthFacade;
use App\Http\Requests\Api\V1\AuthLoginRequest;
use App\Http\Requests\Api\v1\AuthLogoutRequest;

class AuthController extends ApiController
{
    public function login(AuthLoginRequest $request)
    {
        $token = ApiAuthFacade::loginViaPassword($request->get('email'), $request->get('password'));
        return apiResponseData($token);
    }

    public function logout(AuthLogoutRequest $request)
    {
        ApiAuthFacade::logout();
        return apiResponseMessage(__('auth.logout'));
    }
}
