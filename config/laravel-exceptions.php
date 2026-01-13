<?php

declare(strict_types = 1);

return [
    'table' => env('LARAVEL_EXCEPTIONS_TABLE', 'exceptions'),

    'write_to_database' => env('LARAVEL_EXCEPTIONS_WRITE_TO_DATABASE', true),

    // Exception class bindings
    'classes' => [
        'AppException' => JuniorFontenele\LaravelExceptions\Exceptions\AppException::class,
        'ExternalServiceException' => JuniorFontenele\LaravelExceptions\Exceptions\ExternalServiceException::class,
        'HttpException' => JuniorFontenele\LaravelExceptions\Exceptions\HttpException::class,

        'BadRequestHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\BadRequestHttpException::class,
        'UnauthorizedHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\UnauthorizedHttpException::class,
        'AccessDeniedHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\AccessDeniedHttpException::class,
        'NotFoundHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\NotFoundHttpException::class,
        'MethodNotAllowedHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\MethodNotAllowedHttpException::class,
        'SessionExpiredHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\SessionExpiredHttpException::class,
        'UnprocessableEntityHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\UnprocessableEntityHttpException::class,
        'TooManyRequestsHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\TooManyRequestsHttpException::class,
        'InternalServerErrorHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\InternalServerErrorHttpException::class,
        'ServiceUnavailableHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\ServiceUnavailableHttpException::class,
        'GatewayTimeoutHttpException' => JuniorFontenele\LaravelExceptions\Exceptions\Http\GatewayTimeoutHttpException::class,
    ],
];
