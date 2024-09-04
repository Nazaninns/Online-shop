<?php

namespace App\Models;

use App\Enum\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => PaymentStatusEnum::class
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function transitionTo(PaymentStatusEnum $newState): bool
    {
        if ($this->canTransitionTo($newState)) {
            $this->status = $newState;
            $this->save();
            return true;
        }
        return false;
    }

    public function canTransitionTo(PaymentStatusEnum $newState): bool
    {
        return match ($this->status) {
            PaymentStatusEnum::PENDING => in_array($newState, [PaymentStatusEnum::SUCCESSFUL, PaymentStatusEnum::FAILED]),
            PaymentStatusEnum::SUCCESSFUL, PaymentStatusEnum::FAILED => false,
        };
    }
}
