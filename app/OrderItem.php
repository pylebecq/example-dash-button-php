<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $amount
 * @property int $id
 * @property string $currency
 * @property Order $order
 * @property int $order_id
 * @property Product $product
 * @property int $product_id
 * @property int $quantity
 * @property int $total
 */
final class OrderItem extends Model
{
    public function getTotalAttribute(): int
    {
        return $this->amount * $this->quantity;
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
