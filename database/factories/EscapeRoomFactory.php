<?php

namespace Database\Factories;

use App\Models\EscapeRoom;
use App\Models\EscapeRoomDate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscapeRoom>
 */
class EscapeRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // escape_room_theme_id -> get from outside
            'title' => $this->faker->title,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (EscapeRoom $escapeRoom) {
            for ($i = 0; $i < $this->faker->numberBetween(1, 3); $i++) {
                $availableAt = now()->addDays($this->faker->numberBetween(1, 100),)->format('Y-m-d');
                // if already dates exists,
                if ($escapeRoom->dates()->whereDate('available_at', $availableAt)->exists()) {
                    continue;
                }
                EscapeRoomDate::factory()->create([
                    'escape_room_id' => $escapeRoom->id,
                    'available_at' => $availableAt,
                ]);
            }

        });
    }
}
