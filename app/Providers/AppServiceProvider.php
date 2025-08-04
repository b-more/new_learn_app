<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
