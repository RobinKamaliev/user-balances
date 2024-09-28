<?php

declare(strict_types=1);

namespace App\Operation\Dto;

use App\Dto\Dto;
use App\User\Models\User;

/**
 * Дто на создание операции.
 */
final class CreateOperationDto extends Dto
{
    protected User $user;

    protected float $amount;

    protected string $description;

    public function getUser(): User
    {
        return $this->user;
    }

    public function rules(): array
    {
        return [
            'user' => 'required',
            'amount' => 'required|numeric',
            'description' => 'string',
        ];
    }
}
