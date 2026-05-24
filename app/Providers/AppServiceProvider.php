<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BebanOperasional;
use App\Observers\BebanOperasionalObserver;

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
        BebanOperasional::observe(BebanOperasionalObserver::class);
    }
}
