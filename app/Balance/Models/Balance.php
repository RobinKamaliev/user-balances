<?php

declare(strict_types=1);

namespace App\Balance\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property numeric $balance
 */
class Balance extends Model
{
    protected $table = 'balance_users';

    protected $fillable = [
        'user_id',
        'balance',
    ];
}
