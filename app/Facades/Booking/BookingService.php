<?php

namespace App\Facades\Booking;


use App\Exceptions\AlreadyBookedException;
use App\Facades\EscapeRoomTime\EscapeRoomTimeFacade;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    /**
     * get all bookings of user
     * @param User|null $user
     * @return Collection
     */
    public function getAll(?User $user = null): Collection
    {
        return $this->getUser($user)->bookings;
    }

    /**
     * create booking for user
     * @param int $escapeRoomTimeId
     * @param User|null $user
     * @return Booking
     * @throws AlreadyBookedException
     */
    public function create(int $escapeRoomTimeId, ?User $user = null): Booking
    {
        if ($this->isAlreadyBooked($escapeRoomTimeId, $user)) {
            throw new AlreadyBookedException();
        }
        $escapeRoomTime = EscapeRoomTimeFacade::getById($escapeRoomTimeId);
        return $this->getUser($user)->bookings()->create([
            'escape_room_time_id' => $escapeRoomTimeId,
            'price' => $escapeRoomTime->price,
        ]);
    }

    /**
     * Check if user already booked in escape room
     * @param int $escapeRoomTimeId
     * @param User|null $user
     * @return bool
     */
    private function isAlreadyBooked(int $escapeRoomTimeId, ?User $user = null): bool
    {
        return $this->getUser($user)->bookings()->where('escape_room_time_id', $escapeRoomTimeId)->exists();
    }

    /**
     * get user
     * @param User|null $user
     * @return User
     */
    private function getUser(?User $user = null): User
    {
        return $user ?? Auth::user();
    }
}
