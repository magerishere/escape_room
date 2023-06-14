<?php

namespace App\Providers\Facades;

use App\Facades\ApiAuth\ApiAuthService;
use Illuminate\Support\ServiceProvider;

class ApiAuthFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("api_auth_facade", function () {
            return new ApiAuthService();
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

        