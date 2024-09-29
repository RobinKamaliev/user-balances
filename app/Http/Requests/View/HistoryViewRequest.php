<?php

declare(strict_types=1);

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class HistoryViewRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'description' => $this->input('description') ?? '',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'description' => ['string', 'max:255'],
        ];
    }
}
