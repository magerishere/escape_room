<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class EscapeRoomTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_escape_rooms_route_exists(): void
    {
        $response = $this->get(route('api.v1.escape-rooms.index'));

        $response->assertStatus(200);
    }

    public function test_list_escape_rooms_content_as_escape_room_collection_structure()
    {
        $response = $this->get(route('api.v1.escape-rooms.index'));

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'theme',
                ],
            ],
        ]);
    }

    public function test_list_escape_rooms_can_see_by_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('api.v1.escape-rooms.index'));

        $response->assertStatus(200);
    }

    public function test_list_escape_rooms_can_see_by_guest()
    {
        $response = $this->get(route('api.v1.escape-rooms.index'));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_exists()
    {
        $response = $this->get(route('api.v1.escape-rooms.show', 1));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_content_as_escape_room_resource()
    {
        $response = $this->get(route('api.v1.escape-rooms.show', 1));
        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'theme',
            ],
        ]);
    }

    public function test_do_not_show_escape_room_with_wrong_id()
    {
        $response = $this->get(route('api.v1.escape-rooms.show', 'wrong_id'));

        $response->assertStatus(404);
    }

    public function test_show_escape_room_can_see_by_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('api.v1.escape-rooms.show', 1));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_can_see_by_guest()
    {
        $response = $this->get(route('api.v1.escape-rooms.show', 1));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_times_route_exists()
    {
        $response = $this->get(route('api.v1.escape-rooms.showTimes', 1));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_times_as_escape_room_resource()
    {
        $response = $this->get(route('api.v1.escape-rooms.showTimes', 1));

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'available_at',
                    'times' => [
                        '*' => [
                            'id',
                            'capacity',
                            'remaining_capacity',
                            'begin',
                            'end',
                            'price',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function test_do_not_show_escape_room_times_with_wrong_id()
    {
        $response = $this->get(route('api.v1.escape-rooms.showTimes', 'wrong_id'));

        $response->assertStatus(404);
    }

    public function test_show_escape_room_times_can_see_by_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('api.v1.escape-rooms.showTimes', 1));

        $response->assertStatus(200);
    }

    public function test_show_escape_room_times_can_see_by_guest()
    {
        $response = $this->get(route('api.v1.escape-rooms.showTimes', 1));

        $response->assertStatus(200);
    }
}
