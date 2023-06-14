<?php

namespace App\Facades\ApiAuth;

use Illuminate\Support\Facades\Facade;

/**
 * @method static String loginViaPassword(string $email, string $password)
 */
class ApiAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api_auth_facade';
    }
}
