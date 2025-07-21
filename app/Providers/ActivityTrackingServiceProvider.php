<?php
// app/Providers/ActivityTrackingServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityTrackingService;

class ActivityTrackingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ActivityTrackingService::class, function ($app) {
            return new ActivityTrackingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register any global event listeners here if needed
    }
}
