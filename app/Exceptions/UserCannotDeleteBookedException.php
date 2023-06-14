<?php

namespace App\Exceptions;

use Exception;

class UserCannotDeleteBookedException extends Exception
{
    public function render()
    {
        return apiResponseMessage(__('api.user_cannot_delete_booked'));
    }
}
