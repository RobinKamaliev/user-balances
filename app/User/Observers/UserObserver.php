<?php

declare(strict_types=1);

namespace App\User\Observers;

use App\User\Models\User;

/**
 * Обсервер пользователя.
 */
final class UserObserver
{
    public function created(User $user): void
    {
        $user->balance()->firstOrCreate();
    }
}
