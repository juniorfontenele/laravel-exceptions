<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Facades;

use Illuminate\Support\Facades\Facade;
use JuniorFontenele\LaravelExceptions\Services\LaravelExceptionsService;

class LaravelExceptions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaravelExceptionsService::class;
    }
}
