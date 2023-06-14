<?php

namespace Tests\Feature;

use App\Models\EscapeRoom;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_do_not_load_booking_list_for_guest()
    {
        $response = $this->get(route('api.v1.bookings.index'));

        $response->assertStatus(403); // for middleware
    }

    public function test_do_not_load_booking_list_for_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->get(route('api.v1.bookings.index'));
        $response->assertStatus(200); // for middleware
    }

    public function test_booking_index_content_as_booking_resource_collection()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->get(route('api.v1.bookings.index'));

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'price',
                    'discount_price',
                    'time' => [
                        'id',
                        'capacity',
                        'remaining_capacity',
                        'begin',
                        'end',
                        'price'
                    ]
                ],
            ],
        ]);
    }

    public function test_store_booking_by_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);

        $response->assertCreated()->assertJsonStructure([
            'data' => [
                'id',
                'price',
                'discount_price',
                'time',
            ],
        ]);
    }

    public function test_can_not_store_booking_by_user_with_wrong_escape_room_time_id()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 'wrong_id',
        ]);
        $response->assertStatus(422);
    }

    public function test_can_not_store_booking_by_guest()
    {
        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);
        $response->assertStatus(403);
    }

    public function test_can_not_store_booking_when_user_already_booked()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);
        $response->assertCreated();

        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);
        $response->assertStatus(403);
    }

    public function test_can_not_store_booking_by_user_when_is_fully_booked()
    {
        $escapeRoom = EscapeRoom::factory()->create();
        $escapeRoomTime = $escapeRoom->dates()->first()->times()->first();

        $testCapacity = 3;
        $escapeRoomTime->update([
            'capacity' => $testCapacity,
        ]);
        for ($i = 0; $i < $testCapacity + 1; $i++) {
            $user = User::factory()->create();
            Sanctum::actingAs($user);
            $response = $this->post(route('api.v1.bookings.store'), [
                'escape_room_time_id' => $escapeRoomTime->id,
            ]);
            if ($i < $testCapacity) {
                $response->assertCreated();
            } else {
                $response->assertStatus(403);
            }
        }
    }

    public function test_can_delete_self_booking_by_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);

        $firstBookingId = $user->bookings()->first()->id;
        $this->assertIsInt($firstBookingId);

        $response = $this->delete(route('api.v1.bookings.destroy', $firstBookingId));
        $response->assertStatus(200);

        $deletedBook = $user->bookings()->find($firstBookingId);
        $this->assertNull($deletedBook);
    }

    public function test_can_not_delete_others_booking_by_wrong_user()
    {
        $users = User::factory(2)->create();

        $userOne = $users[0];
        Sanctum::actingAs($userOne);

        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);
        $response->assertCreated();
        $firstBookingId = $userOne->bookings()->first()->id;
        $this->assertIsInt($firstBookingId);

        $userTwo = $users[1];
        Sanctum::actingAs($userTwo);

        $response = $this->delete(route('api.v1.bookings.destroy', $firstBookingId));
        $response->assertStatus(403);

        $deletedBook = $userOne->bookings()->find($firstBookingId);
        $this->assertNotNull($deletedBook);
    }

    public function test_can_not_delete_booking_by_wrong_id()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->post(route('api.v1.bookings.store'), [
            'escape_room_time_id' => 1,
        ]);
        $response->assertCreated();


        $response = $this->delete(route('api.v1.bookings.destroy', 'wrong_id'));
        $response->assertStatus(404);


        $deletedBook = $user->bookings()->first();
        $this->assertNotNull($deletedBook);
    }


}
