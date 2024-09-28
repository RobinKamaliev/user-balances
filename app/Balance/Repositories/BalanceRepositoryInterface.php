<?php

declare(strict_types=1);

namespace App\Balance\Repositories;

use App\Balance\Dto\UpdateBalanceDto;
use App\Balance\Models\Balance;
use Throwable;

/**
 * Интерфейс репозитория пользователя.
 */
interface BalanceRepositoryInterface
{
    /**
     * Списание.
     *
     * @throws Throwable
     */
    public function write(UpdateBalanceDto $dto): Balance;

    /**
     * Пополнение.
     *
     * @throws Throwable
     */
    public function topUp(UpdateBalanceDto $dto): Balance;
}
