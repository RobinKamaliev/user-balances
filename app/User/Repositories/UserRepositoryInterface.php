<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\User\Dto\CreateUserDto;
use App\User\Dto\SearchUserDto;
use App\User\Models\User;

/**
 * Интерфейс репозитория пользователя.
 */
interface UserRepositoryInterface
{
    /**
     * Создание пользователя.
     */
    public function create(CreateUserDto $dto): User;

    /**
     * Получение пользователя.
     */
    public function first(SearchUserDto $dto): User;
}
