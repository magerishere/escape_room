<?php

namespace Database\Seeders;

use App\Enums\EscapeRoomThemeName;
use App\Models\EscapeRoomTheme;
use Database\Factories\EscapeRoomThemeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscapeRoomThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themeNames = EscapeRoomThemeName::asArray();
        foreach ($themeNames as $themeName) {
            EscapeRoomTheme::factory()->create([
                'title' => $themeName
            ]);
        }
    }
}
