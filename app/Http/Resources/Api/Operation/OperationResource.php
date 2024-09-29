<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Operation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

final class OperationResource extends JsonResource
{
    /**
     * Преобразовать ресурс в массив.
     */
    public function toArray(Request $request): array
    {
        $this->resource = (object)$this->resource;

        return [
            'amount' => $this->resource->amount,
            'description' => $this->resource->description,
            'created_at' => $this->resource->created_at ?
                Carbon::parse($this->resource->created_at)->format('Y-m-d H:i:s') : '',
        ];
    }
}
