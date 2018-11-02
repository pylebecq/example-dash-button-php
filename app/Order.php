<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Collection $items
 * @property bool $paid
 * @property bool $status
 * @property int $total
 * @property User $user
 * @property int $user_id
 */
class Order extends Model
{
    public const STATUS_PENDING_PAYMENT = 1;
    public const STATUS_PAYMENT_REJECTED = 2;
    public const STATUS_PAID = 3;
    public const STATUS_CANCELED = 4;

    protected $attributes = [
        'status' => self::STATUS_PENDING_PAYMENT,
    ];

    public function getTotalAttribute(): int
    {
        return $this
            ->items
            ->pluck('total')
            ->sum()
        ;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
