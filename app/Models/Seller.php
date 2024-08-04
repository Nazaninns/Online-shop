<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
