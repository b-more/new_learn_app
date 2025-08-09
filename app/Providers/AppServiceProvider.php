<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityTrackingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register ActivityTrackingService directly
        $this->app->singleton(ActivityTrackingService::class, function ($app) {
            return new ActivityTrackingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         \Livewire\Livewire::component('stats-overview', \App\Livewire\StatsOverview::class);
        \Livewire\Livewire::component('app.livewire.stats-overview', \App\Livewire\StatsOverview::class);
    }
}
