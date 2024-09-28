<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Console\Commands\BaseCommand;
use App\Http\Requests\User\RegisterRequest;
use App\User\Services\CreateUserService;
use Exception;
use Illuminate\Support\Facades\Hash;

final class CreateUserCommand extends BaseCommand
{
    private const SUCCESS_USER_ADD = 'Пользователь успешно добавлен.';

    protected $signature = 'user:add {name} {email} {password}';

    public function handle(CreateUserService $service): int
    {
        $this->logStart();

        $data = [
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ];

        try {
            $service->run($data);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }

        $this->logInfo(self::SUCCESS_USER_ADD);
        $this->logFinish();

        return 0;
    }
}
