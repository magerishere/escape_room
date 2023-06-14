<?php

namespace App\Traits;

use App\Models\Booking;
use App\Models\User;

trait Bookingable
{
    /**
     * create booking at first of user created
     * @return void
     */
    public static function bootBookingable()
    {
        static::created(function (User $user) {
            $user->booking()->create();
        });
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
