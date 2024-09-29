<?php

declare(strict_types=1);

namespace Tests\Feature\App\User\Services;

use App\User\Models\User;
use App\User\Services\CreateUserService;
use Tests\TestCase;

/**
 * Тесты CreateUserService.
 *
 * @group CreateUserService
 * @coversDefaultClass CreateUserService
 */
class CreateUserServiceTest extends TestCase
{
    /**
     * Успешный тест запуска сервиса.
     *
     * @covers CreateUserService::run
     */
    public function testRunSuccess(): void
    {
        $data = [
            'email' => $email = $this->faker->email,
            'password' => $password = $this->faker->password,
            'name' => $name = $this->faker->name,
        ];
        /** @var CreateUserService $service */
        $service = app(CreateUserService::class);

        $user = $service->run($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'password' => $password,
            'name' => $name,
        ]);
    }
    //todo-тесты
    // 1. Тестируем каждый новый класс, эндпоинт.
    // 2. Успешные сценарии и не удачные, исключения и разделение результата логики, т.е if, switch и тд.
    // 3. У эндпоинта тестируем код ошибки каждого сценария
    //      (валидацию, авторизацию, права доступа, успех, и кастомные исключения).
    // 4. Чтобы не копипастить и снять нагрузку с тестирования нужно мокать класс уровнем ниже по цепочки.
}
