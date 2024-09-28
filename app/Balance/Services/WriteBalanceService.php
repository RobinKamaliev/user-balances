<?php

declare(strict_types=1);

namespace App\Balance\Services;

use App\Balance\Exceptions\WriteBalanceException;
use App\User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Списание баланса.
 */
final class WriteBalanceService extends AbstractBalanceService
{
    protected const DESCRIPTION = 'Списание';

    public function run(User $user, float $amount): void
    {
        $this->user = $user;
        $this->amount = $amount;

        $operation = $this->createOperation();

        DB::transaction(function () use ($user, $amount, $operation): void {
            if (($this->balance = $user->firstBalanceLockForUpdate()) && ($this->balance->balance >= $amount)) {
                $this->balanceRepository->write($this->createBalanceDto());
                $this->successOperation($operation);
            } else {
                Log::error((new WriteBalanceException())->message, [
                    'user_id' => $user->id,
                    'balance' => $this->balance->balance,
                    'amount' => $amount,
                    'operation_id' => $operation->id,
                ]);

                throw new WriteBalanceException();
            }
        });
    }
}
