<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AlreadyBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.already_booked'), Response::HTTP_FORBIDDEN);
    }
}
