<?php

namespace App\Containers\AppSection\SocialAuth\Providers;

use Illuminate\Support\ServiceProvider;

class SocialAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Configs/appSection-socialAuth.php' => app_path('Ship/Configs/appSection-socialAuth.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Configs/appSection-socialAuth.php', 'appSection-socialAuth'
        );
    }
}
