<?php

declare(strict_types=1);

namespace App\User\Dto;

use App\Dto\Dto;

final class SearchUserDto extends Dto
{
    protected string $email;

    protected string $name;

    public function rules(): array
    {
        return [];
    }
}
