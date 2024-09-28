<?php

declare(strict_types=1);

namespace App\Operation\Repositories;

use App\Operation\Dto\CreateOperationDto;
use App\Operation\Models\Operation;

/**
 * Интерфейс репозитория операций.
 */
interface OperationRepositoryInterface
{
    /**
     * Создание операции.
     */
    public function create(CreateOperationDto $dto): Operation;

    /**
     * Установить статус операции на выполненное.
     */
    public function setCompletedTrue(Operation $operation): Operation;
}
