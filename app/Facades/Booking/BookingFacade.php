<?php

namespace App\Facades\Booking;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class BookingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'booking_facade';
    }
}
