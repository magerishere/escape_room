<?php

namespace Database\Seeders;

use App\Enums\EscapeRoomThemeName;
use App\Facades\EscapeRoomTheme\EscapeRoomThemeFacade;
use App\Models\EscapeRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscapeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = EscapeRoomThemeFacade::getAll()->pluck('id');
        for ($i = 0; $i < 100; $i++) {
            EscapeRoom::factory()->create([
                'escape_room_theme_id' => $themes->random(),
            ]);
        }

    }
}
