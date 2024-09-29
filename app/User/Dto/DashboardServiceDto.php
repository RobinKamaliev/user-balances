<?php

declare(strict_types=1);

namespace App\User\Dto;

use App\Dto\Dto;
use App\User\Models\User;
use Illuminate\Support\Collection;

final class DashboardServiceDto extends Dto
{
    protected User $user;

    protected float $balance;

    protected Collection $operations;

    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function rules(): array
    {
        return [];
    }
}
