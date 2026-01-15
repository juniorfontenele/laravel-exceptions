<?php

declare(strict_types = 1);

namespace JuniorFontenele\LaravelExceptions\Exceptions;

use Throwable;

class HttpException extends AppException
{
    public string $userMessage = "Ocorreu um erro ao processar sua solicitação. Tente novamente.";

    public function __construct(public int $statusCode = 500, string $message = '', public ?string $resource = null, ?Throwable $previous = null)
    {
        $message = $message ?: "Falha ao acessar o recurso";

        $this->resource ??= request()->fullUrl();

        parent::__construct($message, $statusCode, $previous);
    }
}
