<?php

namespace App\Containers\WrittenSection\Documentation\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Configs/writtenSection-documentation.php' => app_path('Ship/Configs/writtenSection-documentation.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Configs/writtenSection-documentation.php', 'writtenSection-documentation'
        );
    }
}
