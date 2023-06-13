<?php

namespace App\Providers\Facades;

use App\Facades\EscapeRoomTheme\EscapeRoomThemeService;
use Illuminate\Support\ServiceProvider;

class EscapeRoomThemeFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("escape_room_theme_facade", function () {
            return new EscapeRoomThemeService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

        