<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function featureOptions(): BelongsToMany
    {
        return $this->belongsToMany(FeatureOption::class);
    }

    public function alarms(): HasMany
    {
        return $this->hasMany(Alarm::class);
    }

    public function customerWithAlarm():BelongsToMany
    {
        return $this->belongsToMany(Customer::class,'alarms','product_id','customer_id');
    }

    public function checkProductQuantity($quantity): bool
    {
        if ($this->quantity > $quantity) return true;
    }
}
