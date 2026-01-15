<?php

declare(strict_types = 1);
use JuniorFontenele\LaravelExceptions\Facades\LaravelExceptions;
use Throwable;

if (! function_exists('laravel_exceptions')) {
    /**
     * Get the LaravelExceptions service instance.
     */
    function laravel_exceptions(int $statusCode = 500, string $message = '', ?Throwable $previous = null): void
    {
        LaravelExceptions::abort(statusCode: $statusCode, message: $message, previous: $previous);
    }
}
