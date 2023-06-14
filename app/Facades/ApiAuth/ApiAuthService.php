<?php

namespace App\Facades\ApiAuth;


use App\Facades\User\UserFacade;
use Illuminate\Support\Facades\Hash;

class ApiAuthService
{
    public function loginViaPassword(string $email, string $password): string
    {
        $user = UserFacade::getByEmail($email);
        if (!$user || !Hash::check($password, $user->password)) {
            abort(403);
        }

        return $user->createToken($email)->plainTextToken;
    }
}
