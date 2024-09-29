<?php

declare(strict_types=1);

namespace App\Balance\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение, при пополнении баланса.
 */
final class TopUpBalanceException extends \Exception
{
    /**
     * Текст сообщения.
     */
    public $message = 'Ошибка при пополнения баланса.';

    /**
     * Код статуса.
     */
    public $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
