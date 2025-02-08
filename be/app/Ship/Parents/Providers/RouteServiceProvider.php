<?php

namespace App\Ship\Parents\Providers;

use Illuminate\Support\Facades\Route;
use Apiato\Core\Abstracts\Providers\RouteServiceProvider as AbstractRouteServiceProvider;

abstract class RouteServiceProvider extends AbstractRouteServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();

        Route::pattern('id', '[0-9]+');
        Route::pattern('date', '[0-9]{4}-[0-9]{2}-[0-9]{2}');

        parent::boot();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
    }
}
