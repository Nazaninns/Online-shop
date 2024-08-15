<?php

namespace App\Http\Resources\Seller\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description'=> $this->description,
            'price'=> $this->price,
            'image'=> $this->image,
            'seller_id'=> $this->seller_id,
            'category_id'=> $this->category_id,
        ];
    }
}
