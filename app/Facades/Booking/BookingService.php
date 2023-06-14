<?php

namespace App\Facades\Booking;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    public function getAll(?User $user = null): Collection
    {
        $user = $user ?? Auth::user();
        return $user->bookings;
    }
}
