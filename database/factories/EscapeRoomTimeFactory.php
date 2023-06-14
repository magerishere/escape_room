<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscapeRoomTime>
 */
class EscapeRoomTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // escape_room_date_id -> get from outside
            // begin -> get from outside
            // end -> get from outside
            'price' => 50000 * $this->faker->numberBetween(1, 10),
            'capacity' => $this->faker->numberBetween(4, 20),
        ];
    }
}
