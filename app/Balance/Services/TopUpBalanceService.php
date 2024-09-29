<?php

declare(strict_types=1);

namespace App\Balance\Services;

use App\Balance\Exceptions\TopUpBalanceException;
use App\User\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Списание баланса.
 */
final class TopUpBalanceService extends AbstractBalanceService
{
    protected const DESCRIPTION = 'Пополнение';

    /**
     * @throws Throwable
     */
    public function run(User $user, float $amount): void
    {
        $this->user = $user;
        $this->amount = $amount;

        $operation = $this->createOperation();

        if ($this->balance = $user->balance) {
            $this->balanceRepository->topUp($this->createBalanceDto());
            $this->successOperation($operation);
        } else {
            Log::error((new TopUpBalanceException())->message, [
                'user_id' => $user->id,
                'balance' => $this->balance->balance,
                'amount' => $amount,
                'operation_id' => $operation->id,
            ]);

            throw new TopUpBalanceException();
        };
    }
}
