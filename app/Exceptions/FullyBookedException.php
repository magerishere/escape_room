<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class FullyBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.fully_booked'), Response::HTTP_FORBIDDEN);
    }
}
