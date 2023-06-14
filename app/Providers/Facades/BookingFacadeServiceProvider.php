<?php

namespace App\Providers\Facades;

use App\Facades\Booking\BookingService;
use Illuminate\Support\ServiceProvider;

class BookingFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("booking_facade", function () {
            return new BookingService();
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

        