<?php

namespace App\Facades\Booking;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getAll(?User $user = null)
 */
class BookingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'booking_facade';
    }
}
