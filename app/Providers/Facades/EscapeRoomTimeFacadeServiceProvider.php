<?php

namespace App\Providers\Facades;

use App\Facades\EscapeRoomTime\EscapeRoomTimeService;
use Illuminate\Support\ServiceProvider;

class EscapeRoomTimeFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("escape_room_time_facade", function () {
            return new EscapeRoomTimeService();
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

        