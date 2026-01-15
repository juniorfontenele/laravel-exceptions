<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions;

use Illuminate\Support\ServiceProvider;

class LaravelExceptionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-exceptions.php' => config_path('laravel-exceptions.php'),
        ], 'config');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-exceptions');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-exceptions.php',
            'laravel-exceptions',
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->bindExceptionClasses();
    }

    private function bindExceptionClasses(): void
    {
        foreach (config('laravel-exceptions.classes', []) as $key => $class) {
            $this->app->bind($key, fn () => $class);
        }
    }
}
