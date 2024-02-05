<?php

namespace SkyBlueSofa\C2CBlanketFramework;

use Illuminate\Support\ServiceProvider;

class C2CBlanketServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__.'/../config/c2c.php' => config_path('c2c/c2c.php'),
            __DIR__.'/../config/temperature-blanket-dot-com/default.txt' => config_path('c2c/temperature-blanket-dot-com/default.txt'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'c2c-blanket');
    }
}
