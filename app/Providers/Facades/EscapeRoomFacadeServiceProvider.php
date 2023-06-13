<?php

namespace App\Providers\Facades;

use App\Facades\EscapeRoom\EscapeRoomService;
use Illuminate\Support\ServiceProvider;

class EscapeRoomFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('escape.room.facade', function () {
            return new EscapeRoomService();
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
