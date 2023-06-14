<?php

namespace App\Facades\Booking;


use App\Exceptions\AlreadyBookedException;
use App\Exceptions\UserCannotDeleteBookedException;
use App\Facades\EscapeRoomTime\EscapeRoomTimeFacade;
use App\Models\Booking;
use App\Models\EscapeRoomTime;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    const discount_percent = 10; // %

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
            'discount_price' => $this->calculateDiscountPrice($escapeRoomTime, $user),
        ]);
    }

    public function delete(Booking $booking, ?User $user = null): void
    {
        if (!$this->canDelete($booking, $user)) {
            throw new UserCannotDeleteBookedException();
        }
        $booking->delete();
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
     * Calculate discount price depends on brith day user
     * @param EscapeRoomTime $escapeRoomTime
     * @param User|null $user
     * @return int|null
     */
    private function calculateDiscountPrice(EscapeRoomTime $escapeRoomTime, ?User $user = null): ?int
    {
        $discount_price = null;
        // if day of escape room date, is same birthdate user
        if (isSameDayAtMonth($this->getUser($user)->birth_date, $escapeRoomTime->date->available_at, false)) {
            $price = $escapeRoomTime->price;
            $discount_price = $price - ($price / self::discount_percent);
        }
        return $discount_price;
    }

    /**
     * only can delete self bookings
     * @param Booking $booking
     * @param User|null $user
     * @return bool
     */
    private function canDelete(Booking $booking, ?User $user = null): bool
    {
        return $this->getUser($user)->id === $booking->user_id;
    }
}
