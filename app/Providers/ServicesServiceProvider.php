<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Http\Contracts\Services\AppointmentServiceContract::class, \App\Http\Services\AppointmentService::class);
        $this->app->bind(\App\Http\Contracts\Services\DentistServiceContract::class, \App\Http\Services\DentistService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
