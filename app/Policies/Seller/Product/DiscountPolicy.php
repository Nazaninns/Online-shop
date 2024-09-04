<?php

namespace App\Policies\Seller\Product;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;

class DiscountPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function add(Seller $seller, Product $product): bool
    {
        return $seller->products->contains($product);
    }
}
