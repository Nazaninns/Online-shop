<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FeatureOption extends Model
{
    use HasFactory;

    public function feature():BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
