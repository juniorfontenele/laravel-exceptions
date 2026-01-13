<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Facades;

use JuniorFontenele\LaravelExceptions\Services\LaravelExceptionsService;
use Illuminate\Support\Facades\Facade;

class LaravelExceptions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaravelExceptionsService::class;
    }
}
