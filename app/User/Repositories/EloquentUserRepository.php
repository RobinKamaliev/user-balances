<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\User\Dto\CreateUserDto;
use App\User\Dto\SearchUserDto;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;

/**
 * Репозиторий пользователя.
 */
final class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * Создание пользователя.
     */
    public function create(CreateUserDto $dto): User
    {
        /** @var User */
        return User::query()->create($dto->toArray());
    }

    /**
     * Получение пользователя.
     *
     * @throws UserNotFoundException
     */
    public function first(SearchUserDto $dto): User
    {
        /** @var User $user */
        $user = User::query()->where($dto->toArray())->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
