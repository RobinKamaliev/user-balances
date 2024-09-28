<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Базовая команда.
 */
class BaseCommand extends Command
{
    protected $signature = 'base';

    /**
     * Текст сообщения о начале работы команды.
     */
    protected const LOG_START_MESSAGE = 'Начало работы команды: ';

    /**
     * Текст сообщения о завершении работы команды.
     */
    protected const LOG_FINISH_MESSAGE = 'Завершение работы команды: ';

    /**
     * Логирование успешного сообщения.
     */
    protected function logInfo(string $message, array $additionalContext = null): void
    {
        $context = ['command' => $this->name];

        if ($additionalContext) {
            $context = array_merge($context, $additionalContext);
        }

        $this->info($message);
        Log::info($message, $context);
    }

    /**
     * Логирование начала работы команды.
     */
    protected function logStart(): void
    {
        $message = self::LOG_START_MESSAGE . $this->description;

        $this->line($message);
        Log::info($message, ['command' => $this->name]);
    }

    /**
     * Логирование завершения работы команды.
     */
    protected function logFinish(): void
    {
        $message = self::LOG_FINISH_MESSAGE . $this->description;

        $this->line($message);
        Log::info($message, ['command' => $this->name]);
    }

    /**
     * Валидация.
     */
    protected function validated($data = [], $rules = []): bool
    {
        $validator = Validator::make($data, $rules);

        if ($hasErrors = $validator->fails()) {
            Log::error('Ошибка валидации.', [
                'class' => get_class($this),
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
            $this->error('Validation failed: ' . $validator->errors());

            return $hasErrors;
        }

        return $hasErrors;
    }
}
