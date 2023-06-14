<?php

namespace App\Exceptions;

use Exception;

class FullyBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.fully_booked'));
    }
}
