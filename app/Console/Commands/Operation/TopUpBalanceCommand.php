<?php

declare(strict_types=1);

namespace App\Console\Commands\Operation;

use App\Console\Commands\BaseCommand;
use App\Jobs\TopUpBalanceJob;
use App\User\Dto\SearchUserDto;
use App\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Консольная команда на зачисление баланса у пользователя.
 */
final class TopUpBalanceCommand extends BaseCommand
{
    protected $signature = 'balance:top-up {email} {amount}';

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
            TopUpBalanceJob::dispatchSync($user, $this->argument('amount'));
        } catch (Throwable $e) {
            Log::error(TopUpBalanceJob::ERROR, [
                'error_message' => $e->getMessage(),
            ]);
            $this->error(TopUpBalanceJob::ERROR . ' ' . $e->getMessage());

            return 1;
        }

        $this->logFinish();

        return 0;
    }
}
