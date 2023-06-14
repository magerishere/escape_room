<?php

namespace Tests\Unit;

use App\Facades\Booking\BookingFacade;
use App\Facades\EscapeRoomTime\EscapeRoomTimeFacade;
use App\Models\EscapeRoom;
use App\Models\EscapeRoomTime;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_calculate_discount_price_when_user_birthday_and_escape_room_time_is_same_day(): void
    {
        $user = User::factory()->create();
        $this->assertNotNull($user);
        Sanctum::actingAs($user);

        $escapeRoom = EscapeRoom::factory()->create([
            'title' => 'test'
        ]);


        $firstEscapeRoomDate = $escapeRoom->dates()->first();
        $this->assertNotNull($firstEscapeRoomDate);
        $firstEscapeRoomDate->update([
            'available_at' => $user->birth_date->addYears(10)
        ]);

        $escapeRoomTimeId = $escapeRoom->dates->first()->times()->first()->id;
        $booking = BookingFacade::create($escapeRoomTimeId, $user);
        $this->assertNotNull($booking->discount_price);

        $escapeRoomTime = EscapeRoomTimeFacade::getById($escapeRoomTimeId);
        $escapeRoomTimeDiscountPriceActual = $escapeRoomTime->price - ($escapeRoomTime->price / 10);

        $this->assertTrue($booking->discount_price === $escapeRoomTimeDiscountPriceActual);
    }
}
