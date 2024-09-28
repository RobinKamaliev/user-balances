<?php

declare(strict_types=1);

namespace App\Balance\Services;

use App\Balance\Dto\UpdateBalanceDto;
use App\Balance\Models\Balance;
use App\Balance\Repositories\BalanceRepositoryInterface;
use App\Operation\Dto\CreateOperationDto;
use App\Operation\Models\Operation;
use App\Operation\Repositories\OperationRepositoryInterface;
use App\User\Models\User;

/**
 * Абстрактный класс по изменению балансу пользователя.
 */
abstract class AbstractBalanceService
{
    protected const DESCRIPTION = 'Описание операции.';

    protected User $user;

    protected float $amount;

    protected Balance $balance;

    public function __construct(
        readonly OperationRepositoryInterface $operationRepository,
        readonly BalanceRepositoryInterface   $balanceRepository
    )
    {
    }

    abstract public function run(User $user, float $amount): void;

    /**
     * Создание операции.
     */
    protected function createOperation(): Operation
    {
        return $this->operationRepository->create($this->createOperationDto());
    }

    /**
     * Изменение статуса операции на выполненное.
     */
    protected function successOperation(Operation $operation): void
    {
        $this->operationRepository->setCompletedTrue($operation);
    }

    /**
     * Создание дто для создании операции.
     */
    protected function createOperationDto(): CreateOperationDto
    {
        return CreateOperationDto::factory([
            'user' => $this->user,
            'amount' => $this->amount,
            'description' => static::DESCRIPTION,
        ]);
    }

    /**
     * Создание дто для изменения баланса.
     */
    protected function createBalanceDto(): UpdateBalanceDto
    {
        return UpdateBalanceDto::factory([
            'balance' => $this->balance,
            'amount' => $this->amount,
        ]);
    }
}
