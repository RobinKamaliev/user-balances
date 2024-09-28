<?php

declare(strict_types=1);

namespace App\Balance\Providers;

use App\Balance\Repositories\BalanceRepositoryInterface;
use App\Balance\Repositories\EloquentBalanceRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис-провайдер баланса пользователя.
 */
final class BalanceServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов.
     */
    public function register(): void
    {
        $this->app->bind(BalanceRepositoryInterface::class, EloquentBalanceRepository::class);
    }
}
