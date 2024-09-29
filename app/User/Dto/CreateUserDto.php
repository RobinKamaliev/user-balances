<?php

declare(strict_types=1);

namespace App\User\Dto;

use App\Dto\Dto;
use App\User\Models\User;
use Illuminate\Validation\Rule;

final class CreateUserDto extends Dto
{
    protected string $email;

    protected string $name;

    protected string $password;

    public function rules(): array
    {
        return [
            'email' => ['email', 'required', 'min:10' , 'max:30', Rule::unique(User::class)],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['required', 'min:7' , 'max:255'],
        ];
    }
}
