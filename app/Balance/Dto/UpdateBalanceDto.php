<?php

declare(strict_types=1);

namespace App\Balance\Dto;

use App\Balance\Models\Balance;
use App\Dto\Dto;

/**
 * Дто на изменение баланса.
 */
final class UpdateBalanceDto extends Dto
{
    protected Balance $balance;

    protected float $amount;

    public function getBalance(): Balance
    {
        return $this->balance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function rules(): array
    {
        return [
            'balance' => 'required',
            'amount' => 'required|numeric',
        ];
    }
}
