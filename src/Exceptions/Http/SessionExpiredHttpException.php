<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Exceptions\Http;

use JuniorFontenele\LaravelExceptions\Exceptions\HttpException;
use Throwable;

class SessionExpiredHttpException extends HttpException
{
    public function __construct(string $message = '', public ?string $resource = null, ?Throwable $previous = null)
    {
        $this->userMessage = "O tempo da sua sessão expirou. Por favor, atualize a página e faça login novamente.";

        $message = $message ?: "Sessão expirada";

        parent::__construct(419, $message, $resource, $previous);
    }
}
