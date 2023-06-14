<?php

namespace App\Providers\Facades;

use App\Facades\User\UserService;
use Illuminate\Support\ServiceProvider;

class UserFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton("user_facade", function () {
            return new UserService();
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

        