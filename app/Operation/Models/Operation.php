<?php

declare(strict_types=1);

namespace App\Operation\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property boolean $completed
 */
class Operation extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'completed',
    ];
}
