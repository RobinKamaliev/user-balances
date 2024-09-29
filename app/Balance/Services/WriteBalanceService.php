<?php

declare(strict_types=1);

namespace App\Balance\Services;

use App\Balance\Exceptions\WriteBalanceException;
use App\Balance\Models\Balance;
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

        DB::transaction(function () use ($operation): void {
            if (!($this->balance = $this->user->firstBalanceLockForUpdate()) && !($this->balance->balance >= $this->amount)) {
                Log::error((new WriteBalanceException())->message, [
                    'user_id' => $this->user->id,
                    'balance' => optional($this->balance)->balance,
                    'amount' => $this->amount,
                    'operation_id' => $operation->id,
                ]);

                throw new WriteBalanceException();
            }

            $this->balanceRepository->write($this->createBalanceDto());
            $this->successOperation($operation);
        });
    }
}
