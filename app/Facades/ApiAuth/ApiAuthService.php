<?php

namespace App\Facades\ApiAuth;


use App\Facades\User\UserFacade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class ApiAuthService
{
    public function loginViaPassword(string $email, string $password): string
    {
        $user = UserFacade::getByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new UnauthorizedException();
        }

        return $user->createToken($email)->plainTextToken;
    }
}
