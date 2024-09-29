<?php

declare(strict_types=1);

namespace App\User\Services;

use App\User\Dto\DashboardServiceDto;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Сервис получения атрибут для dashboard.
 */
final class DashboardService
{
    private const COUNT_OPERATION = 5;

    /**
     * @throws UserNotFoundException
     */
    public function run(): DashboardServiceDto
    {
        /** @var User $user */
        if (!$user = Auth::user()) {
            throw new UserNotFoundException();
        }

        $data = [
            'balance' => (float)(optional($user->balance)->balance ?? 0),
            'operations' => $user->lastTakeOperations(self::COUNT_OPERATION),
        ];

        return $this->createDashboardServiceDto($data);
    }

    private function createDashboardServiceDto(array $data): DashboardServiceDto
    {
        return DashboardServiceDto::factory($data);
    }
}
