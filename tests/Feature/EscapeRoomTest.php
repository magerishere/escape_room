<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EscapeRoomTest extends TestCase
{
    use DatabaseMigrations;

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

}
