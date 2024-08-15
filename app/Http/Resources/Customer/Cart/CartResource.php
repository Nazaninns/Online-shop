<?php

namespace App\Http\Resources\Customer\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cart = [];
        foreach ($this->resource as $productId => $count) {
            $cart[] = [
                'product_id' => $productId,
                'count' => $count,
            ];
        }

        return $cart;
    }
}
