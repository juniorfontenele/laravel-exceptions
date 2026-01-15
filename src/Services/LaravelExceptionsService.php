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
            match ($e->getStatusCode()) {
                404 => $this->throwHttpException('NotFoundHttpException', $e),
                403 => $this->throwHttpException('AccessDeniedHttpException', $e),
                401 => $this->throwHttpException('UnauthorizedHttpException', $e),
                419 => $this->throwHttpException('SessionExpiredHttpException', $e),
                500 => $this->throwHttpException('InternalServerErrorHttpException', $e),
                503 => $this->throwHttpException('ServiceUnavailableHttpException', $e),
                504 => $this->throwHttpException('GatewayTimeoutHttpException', $e),
                400 => $this->throwHttpException('BadRequestHttpException', $e),
                405 => $this->throwHttpException('MethodNotAllowedHttpException', $e),
                422 => $this->throwHttpException('UnprocessableEntityHttpException', $e),
                429 => $this->throwHttpException('TooManyRequestsHttpException', $e),
                default => $this->throwHttpException('HttpException', $e, $e->getStatusCode()),
            };
        });

        $exceptions->render(function (Throwable $e) {
            return match (true) {
                $e instanceof AuthenticationException => false,
                $e instanceof ValidationException => false,
                $e instanceof AppException => null,
                default => $this->throwAppException('AppException', $e),
            };
        });
    }

    private function throwHttpException(string $httpExceptionKey, LaravelHttpException $previous, ?int $statusCode = null): never
    {
        $class = app()->make($httpExceptionKey);

        throw new $class(
            previous: $previous,
            statusCode: $statusCode,
        );
    }

    private function throwAppException(string $appExceptionKey, Throwable $previous): never
    {
        $class = app()->make($appExceptionKey);

        throw new $class(
            $previous->getMessage(),
            $previous->getCode(),
            $previous
        );
    }
}
