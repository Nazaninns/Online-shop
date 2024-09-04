<?php

namespace App\Models;

use App\Enum\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function transitionTo(OrderStatusEnum $newState): bool
    {
        if ($this->canTransitionTo($newState)) {
            $this->status = $newState;
            $this->save();
            return true;
        }
        return false;
    }

    public function canTransitionTo(OrderStatusEnum $newState): bool
    {
        return match ($this->status) {
            OrderStatusEnum::PAID => in_array($newState, [OrderStatusEnum::PREPARING, OrderStatusEnum::SHIPPING]),
            OrderStatusEnum::PREPARING => $newState === OrderStatusEnum::SHIPPING,
            OrderStatusEnum::SHIPPING => $newState === OrderStatusEnum::DELIVERED,
            OrderStatusEnum::DELIVERED => false,
            default => false,
        };
    }
}
