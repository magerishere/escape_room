<?php

namespace App\Facades\User;

use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static User|null getByEmail
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'user_facade';
    }
}
