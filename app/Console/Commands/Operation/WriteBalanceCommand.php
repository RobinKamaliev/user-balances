<?php

declare(strict_types=1);

namespace App\Console\Commands\Operation;

use App\Console\Commands\BaseCommand;
use App\Jobs\WriteBalanceJob;
use App\User\Dto\SearchUserDto;
use App\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Консольная команда на списание баланса у пользователя.
 */
final class WriteBalanceCommand extends BaseCommand
{
    protected $signature = 'balance:write {email} {amount}';

    public function handle(UserRepositoryInterface $userRepository): int
    {
        $this->logStart();

        try {
            $user = $userRepository->first(SearchUserDto::factory(['email' => $this->argument('email')]));
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }

        try {
            WriteBalanceJob::dispatch($user, $this->argument('amount'));
        } catch (Throwable $e) {
            Log::error(WriteBalanceJob::ERROR, [
                'error_message' => $e->getMessage(),
            ]);
            $this->error(WriteBalanceJob::ERROR . ' ' . $e->getMessage());

            return 1;
        }

        $this->logFinish();

        return 0;
    }
}
