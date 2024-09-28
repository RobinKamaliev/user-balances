<?php

declare(strict_types=1);

namespace App\User\Models;

use App\Balance\Models\Balance;
use App\Operation\Models\Operation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property Balance $balance
 * @property Collection $operations
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class)->orderByDesc('created_at');
    }

    /**
     * Получение баланса пользователя с блокировкой.
     */
    public function firstBalanceLockForUpdate(): Balance
    {
        /** @var Balance */
        return $this->balance()->lockForUpdate()->first();
    }
}
