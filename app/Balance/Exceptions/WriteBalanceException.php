<?php

declare(strict_types=1);

namespace App\Balance\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение, при списании баланса.
 */
final class WriteBalanceException extends \Exception
{
    /**
     * Текст сообщения.
     */
    public $message = 'Недостаточно баланса.';

    /**
     * Код статуса.
     */
    public $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
