<?php

declare(strict_types=1);

namespace App\Dto\Exceptions;

use App\Exceptions\Base\HttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение валидации объекта данных.
 */
final class DtoValidationException extends HttpException
{
    /**
     * Текст сообщения.
     */
    public $message = 'Ошибка валидации объекта данных.';

    /**
     * Код статуса.
     */
    public $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
