<?php

declare(strict_types=1);

namespace App\User\Providers;

use App\User\Models\User;
use App\User\Observers\UserObserver;
use App\User\Repositories\EloquentUserRepository;
use App\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис-провайдер пользователя.
 */
final class UserServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
    /**
     * Регистрация сервисов.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }
}
