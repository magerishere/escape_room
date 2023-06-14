<?php

namespace App\Facades\ApiAuth;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class ApiAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api_auth_facade';
    }
}
