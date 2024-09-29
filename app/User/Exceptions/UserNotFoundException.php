<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение, когда пользователь не найден.
 */
final class UserNotFoundException extends \Exception
{
    /**
     * Текст сообщения.
     */
    public $message = 'Пользователь не найден.';

    /**
     * Код статуса.
     */
    public $code = Response::HTTP_NOT_FOUND;
}
