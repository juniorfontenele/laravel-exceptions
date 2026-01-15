<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use JuniorFontenele\LaravelExceptions\Exceptions\AppException;
use Symfony\Component\HttpKernel\Exception\HttpException as LaravelHttpException;
use Throwable;

class LaravelExceptionsService
{
    public function handles(Exceptions $exceptions): void
    {
        $exceptions->render(function (LaravelHttpException $e) {
            $this->abort(statusCode: $e->getStatusCode(), previous: $e);
        });

        $exceptions->render(function (Throwable $e) {
            return match (true) {
                $e instanceof AuthenticationException => false,
                $e instanceof ValidationException => false,
                $e instanceof AppException => null,
                default => $this->throwAppException($e),
            };
        });
    }

    public function abort(int $statusCode = 500, string $message = '', ?Throwable $previous = null): void
    {
        match ($statusCode) {
            404 => $this->throwHttpException(httpExceptionKey: 'NotFoundHttpException', message: $message, previous: $previous),
            403 => $this->throwHttpException('AccessDeniedHttpException', $message, $previous),
            401 => $this->throwHttpException('UnauthorizedHttpException', $message, $previous),
            419 => $this->throwHttpException('SessionExpiredHttpException', $message, $previous),
            500 => $this->throwHttpException('InternalServerErrorHttpException', $message, $previous),
            503 => $this->throwHttpException('ServiceUnavailableHttpException', $message, $previous),
            504 => $this->throwHttpException('GatewayTimeoutHttpException', $message, $previous),
            400 => $this->throwHttpException('BadRequestHttpException', $message, $previous),
            405 => $this->throwHttpException('MethodNotAllowedHttpException', $message, $previous),
            422 => $this->throwHttpException('UnprocessableEntityHttpException', $message, $previous),
            429 => $this->throwHttpException('TooManyRequestsHttpException', $message, $previous),
            default => $this->throwHttpException('HttpException', $message, $previous),
        };
    }

    public function throwHttpException(string $httpExceptionKey, string $message = '', ?Throwable $previous = null): never
    {
        $class = app()->make($httpExceptionKey);

        throw new $class(
            message: $message,
            previous: $previous,
        );
    }

    public function throwAppException(Throwable $previous): never
    {
        $class = app()->make('AppException');

        throw new $class(
            message: $previous->getMessage(),
            code: $previous->getCode(),
            previous: $previous,
        );
    }
}
