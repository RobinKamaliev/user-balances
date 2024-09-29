<?php

declare(strict_types=1);

namespace App\Operation\Providers;

use App\Operation\Repositories\EloquentOperationRepository;
use App\Operation\Repositories\OperationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис-провайдер операции.
 */
final class OperationServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов.
     */
    public function register(): void
    {
        $this->app->bind(OperationRepositoryInterface::class, EloquentOperationRepository::class);
    }
}
