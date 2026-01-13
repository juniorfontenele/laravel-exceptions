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
        $this->app->bind('AppException', function () {
            return config('laravel-exceptions.classes.AppException');
        });

        $this->app->bind('ExternalServiceException', function () {
            return config('laravel-exceptions.classes.ExternalServiceException');
        });

        $this->app->bind('HttpException', function () {
            return config('laravel-exceptions.classes.HttpException');
        });

        $this->app->bind('BadRequestHttpException', function () {
            return config('laravel-exceptions.classes.BadRequestHttpException');
        });

        $this->app->bind('UnauthorizedHttpException', function () {
            return config('laravel-exceptions.classes.UnauthorizedHttpException');
        });

        $this->app->bind('AccessDeniedHttpException', function () {
            return config('laravel-exceptions.classes.AccessDeniedHttpException');
        });

        $this->app->bind('NotFoundHttpException', function () {
            return config('laravel-exceptions.classes.NotFoundHttpException');
        });

        $this->app->bind('MethodNotAllowedHttpException', function () {
            return config('laravel-exceptions.classes.MethodNotAllowedHttpException');
        });

        $this->app->bind('SessionExpiredHttpException', function () {
            return config('laravel-exceptions.classes.SessionExpiredHttpException');
        });

        $this->app->bind('UnprocessableEntityHttpException', function () {
            return config('laravel-exceptions.classes.UnprocessableEntityHttpException');
        });

        $this->app->bind('TooManyRequestsHttpException', function () {
            return config('laravel-exceptions.classes.TooManyRequestsHttpException');
        });

        $this->app->bind('InternalServerErrorHttpException', function () {
            return config('laravel-exceptions.classes.InternalServerErrorHttpException');
        });

        $this->app->bind('ServiceUnavailableHttpException', function () {
            return config('laravel-exceptions.classes.ServiceUnavailableHttpException');
        });

        $this->app->bind('GatewayTimeoutHttpException', function () {
            return config('laravel-exceptions.classes.GatewayTimeoutHttpException');
        });
    }
}
