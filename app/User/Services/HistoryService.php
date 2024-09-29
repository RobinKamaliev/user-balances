<?php

declare(strict_types=1);

namespace App\User\Services;

use App\User\Dto\DashboardServiceDto;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Сервис получения атрибут для history.
 */
final class HistoryService
{
    private const LIMIT_COUNT_OPERATIONS = 10;

    /**
     * @throws UserNotFoundException
     */
    public function run(string $query): DashboardServiceDto
    {
        /** @var User $user */
        if (!$user = Auth::user()) {
            throw new UserNotFoundException();
        }

        return $this->createDashboardUserServiceDto([
            'operations' => $user->operationsByLike($query, self::LIMIT_COUNT_OPERATIONS),
        ]);
    }

    private function createDashboardUserServiceDto(array $data): DashboardServiceDto
    {
        return DashboardServiceDto::factory($data);
    }
}
