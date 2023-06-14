<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\ApiAuth\ApiAuthFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthLoginRequest;
use App\Http\Requests\Api\v1\AuthLogoutRequest;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public function login(AuthLoginRequest $request)
    {
        $token = ApiAuthFacade::loginViaPassword($request->get('email'), $request->get('password'));
        return response()->json([
            'data' => $token,
        ]);
    }

    public function logout(AuthLogoutRequest $request)
    {
        ApiAuthFacade::logout();
        return response()->json([
            'data' => __('auth.logout')
        ]);
    }
}
