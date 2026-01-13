<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException as LaravelHttpException;
use Throwable;

class LaravelExceptionsService
{
    public function handles(Exceptions $exceptions): void
    {
        $exceptions->render(function (LaravelHttpException $e) {
            match ($e->getStatusCode()) {
                404 => throw new (app()->make('NotFoundHttpException'))(
                    previous: $e,
                ),
                403 => throw new (app()->make('AccessDeniedHttpException'))(
                    previous: $e,
                ),
                401 => throw new (app()->make('UnauthorizedHttpException'))(
                    previous: $e,
                ),
                419 => throw new (app()->make('SessionExpiredHttpException'))(
                    previous: $e,
                ),
                500 => throw new (app()->make('InternalServerErrorHttpException'))(
                    previous: $e,
                ),
                503 => throw new (app()->make('ServiceUnavailableHttpException'))(
                    previous: $e,
                ),
                504 => throw new (app()->make('GatewayTimeoutHttpException'))(
                    previous: $e,
                ),
                400 => throw new (app()->make('BadRequestHttpException'))(
                    previous: $e,
                ),
                405 => throw new (app()->make('MethodNotAllowedHttpException'))(
                    previous: $e,
                ),
                422 => throw new (app()->make('UnprocessableEntityHttpException'))(
                    previous: $e,
                ),
                429 => throw new (app()->make('TooManyRequestsHttpException'))(
                    previous: $e,
                ),
                default => throw new (app()->make('HttpException'))(
                    statusCode: $e->getStatusCode(),
                    previous: $e,
                ),
            };
        });

        $exceptions->render(function (Throwable $e) {
            return match (true) {
                $e instanceof AuthenticationException => false,
                $e instanceof ValidationException => false,
                default => null,
            };

            if (! $e instanceof AppException) {
                throw new (app()->make('AppException'))(
                    $e->getMessage(),
                    $e->getCode(),
                    $e
                );
            }
        });
    }
}
