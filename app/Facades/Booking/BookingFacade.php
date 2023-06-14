<?php

namespace App\Facades\Booking;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getAll(?User $user = null)
 * @method static Booking create(int $escapeRoomTimeId, ?User $user = null)
 * @method static bool isAlreadyBooked(int $escapeRoomTimeId, ?User $user = null)
 * @method static User getUser(?User $user = null)
 */
class BookingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'booking_facade';
    }
}
