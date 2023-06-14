<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserCannotDeleteBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.user_cannot_delete_booked'), Response::HTTP_FORBIDDEN);
    }
}
