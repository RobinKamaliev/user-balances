<?php

declare(strict_types=1);

namespace App\Operation\Repositories;

use App\Operation\Dto\CreateOperationDto;
use App\Operation\Models\Operation;
use Throwable;

/**
 * Репозиторий операций.
 */
final class EloquentOperationRepository implements OperationRepositoryInterface
{
    /**
     * Создание операции.
     */
    public function create(CreateOperationDto $dto): Operation
    {
        /** @var Operation */
        return $dto->getUser()->operations()->create($dto->toArray());
    }

    /**
     * Установить статус операции на выполненное.
     *
     * @throws Throwable
     */
    public function setCompletedTrue(Operation $operation): Operation
    {
        $operation->completed = true;
        $operation->saveOrFail();

        return $operation;
    }
}
