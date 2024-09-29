<?php

declare(strict_types=1);

namespace App\Dto;

use App\Dto\Exceptions\DtoValidationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Абстрактный класс объекта данных.
 */
abstract class Dto
{
    /**
     * Массив атрибутов, установленных в Dto.
     */
    protected array $initialized = [];

    /**
     * Инициализация.
     *
     * @throws DtoValidationException
     */
    public function __construct(array $data)
    {
        $this->validate($data);
        $this->setProperties($data);
    }

    /**
     * Правила валидации.
     */
    abstract public function rules(): array;

    /**
     * Валидации параметров.
     *
     * @throws DtoValidationException
     */
    public function validate(array $data): void
    {
        $validator = Validator::make($data, static::rules());

        if ($validator->fails()) {
            Log::error('Ошибка валидации объекта данных', [
                'class' => get_class($this),
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
            throw new DtoValidationException();
        }
    }

    /**
     * Представление в виде массива.
     */
    public function toArray(): array
    {
        return $this->getProperties()
            ->filter(function ($value, $key): bool {
                return in_array($key, $this->initialized);
            })
            ->mapWithKeys(static function ($value, $key): array {
                return [
                    Str::snake($key) => $value,
                ];
            })
            ->toArray();
    }

    /**
     * Получение атрибутов объекта.
     */
    private function getProperties(): Collection
    {
        return collect(get_object_vars($this))->forget('initialized');
    }

    /**
     * Установка атрибутов объекта.
     */
    private function setProperties(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $propertyCamel = Str::camel($key))) {
                $this->{$propertyCamel} = $value;
                $this->initialized[] = $propertyCamel;
            }
        }
    }

    /**
     * Фабрика дто.
     *
     * @throws DtoValidationException
     */
    public static function factory(array $data): static
    {
        return new static($data);
    }
}
