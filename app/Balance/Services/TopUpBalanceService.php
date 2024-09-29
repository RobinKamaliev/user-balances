<?php

declare(strict_types=1);

namespace App\Balance\Services;

use App\Balance\Exceptions\TopUpBalanceException;
use App\User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Пополнение баланса.
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

        DB::transaction(function () use ($operation): void {
            if (!($this->balance = $this->user->firstBalanceLockForUpdate())) {
                Log::error((new TopUpBalanceException())->message, [
                    'user_id' => $this->user->id,
                    'balance' => optional($this->balance)->balance,
                    'amount' => $this->amount,
                    'operation_id' => $operation->id,
                ]);

                throw new TopUpBalanceException();
            }

            $this->balanceRepository->topUp($this->createBalanceDto());
            $this->successOperation($operation);
        });
    }
}
