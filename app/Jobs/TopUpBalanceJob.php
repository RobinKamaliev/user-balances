<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Balance\Exceptions\TopUpBalanceException;
use App\Balance\Services\TopUpBalanceService;
use App\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TopUpBalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const ERROR = 'Ошибка отправки очереди ' . self::class;

    public function __construct(readonly User $user, readonly float $amount)
    {
    }

    /**
     * @throws TopUpBalanceException
     */
    public function handle(TopUpBalanceService $service): void
    {
        $service->run($this->user, $this->amount);
    }
}
