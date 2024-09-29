<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Operation\OperationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property numeric $balance
 */
final class DashboardResource extends JsonResource
{
    /**
     * Преобразовать ресурс в массив.
     */
    public function toArray(Request $request): array
    {
        $this->resource = (object)$this->resource;

        return [
            'balance' => $this->resource->balance,
            'operations' => OperationResource::collection($this->resource->operations),
        ];
    }
}
