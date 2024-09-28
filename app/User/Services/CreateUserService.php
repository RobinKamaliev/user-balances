<?php

declare(strict_types=1);

namespace App\User\Services;

use App\User\Dto\CreateUserDto;
use App\User\Models\User;
use App\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Arr;

/**
 * Сервис создания пользователя.
 */
final class CreateUserService
{
    public function __construct(readonly UserRepositoryInterface $userRepository)
    {
    }

    public function run(array $data): User
    {
        return $this->userRepository->create($this->createUserDto($data));
    }

    /**
     * Создание дто для создания пользователя.
     */
    private function createUserDto(array $data): CreateUserDto
    {
        return CreateUserDto::factory([
            'email' => Arr::get($data, 'email'),
            'password' => Arr::get($data, 'password'),
            'name' => Arr::get($data, 'name'),
        ]);
    }
}
