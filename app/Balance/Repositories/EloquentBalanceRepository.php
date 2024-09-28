<?php

declare(strict_types=1);

namespace App\Balance\Repositories;

use App\Balance\Dto\UpdateBalanceDto;
use App\Balance\Models\Balance;
use Throwable;

/**
 * Репозиторий баланса пользователя.
 */
final class EloquentBalanceRepository implements BalanceRepositoryInterface
{
    /**
     * Пополнение.
     *
     * @throws Throwable
     */
    public function write(UpdateBalanceDto $dto): Balance
    {
        $balanceUser = $dto->getBalance();
        $balanceUser->balance -= $dto->getAmount();
        $balanceUser->saveOrFail();

        return $balanceUser;
    }

    /**
     * Списание.
     *
     * @throws Throwable
     */
    public function topUp(UpdateBalanceDto $dto): Balance
    {
        $balanceUser = $dto->getBalance();
        $balanceUser->balance += $dto->getAmount();
        $balanceUser->saveOrFail();

        return $balanceUser;
    }
}
