<?php

namespace Database\Factories;

use App\Models\EscapeRoomDate;
use App\Models\EscapeRoomTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscapeRoomDate>
 */
class EscapeRoomDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // escape_room_id -> get from outside
            // available_at -> get from outside
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (EscapeRoomDate $escapeRoomDate) {
            for ($i = 0; $i < $this->faker->numberBetween(1, 3); $i++) {
                $begin = now()->startOfDay()->addHours($this->faker->numberBetween(1, 23));
                // coefficient between times 3 -> 15,30,45,60,... 105
                $end = $begin->copy()->addMinutes($this->faker->numberBetween(1, 7) * 15);
                $times = $escapeRoomDate->times();
                // if times already exists
                if ($times->whereBetween('begin', [$begin, $end])->exists() || $times->whereBetween('end', [$begin, $end])->exists()) {
                    continue;
                }

                EscapeRoomTime::factory()->create([
                    'escape_room_date_id' => $escapeRoomDate->id,
                    'begin' => $begin,
                    'end' => $end,
                ]);
            }
        });
    }
}
