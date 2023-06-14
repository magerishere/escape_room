<?php

namespace App\Exceptions;

use Exception;

class AlreadyBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.already_booked'));
    }
}
