<?php

namespace App\Facades\User;


use App\Models\User;

class UserService
{
    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
