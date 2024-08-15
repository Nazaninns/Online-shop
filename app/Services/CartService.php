<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CartService
{
    public function __construct(public int $userId)
    {
    }

    public function get()
    {
        if (Cache::has('cart_' . $this->userId)) {
            return Cache::get('cart_' . $this->userId);
        }
        return $this->create();
    }

    private function create(): array
    {
        Cache::put('cart_' . $this->userId, [], 2 * 60 * 60 * 24);
        return [];
    }

    public function addProduct(int $productId, int $quantity): void
    {
        $cart = $this->get();
        $count = $this->checkProductCountInCart($productId, $cart);
        $count = $count + $quantity;
        $cart[$productId] = $count;
        Cache::put('cart_' . $this->userId, $cart, 2 * 60 * 60 * 24);
    }

    public function checkProductCountInCart(int $productId, array $cart)
    {
        $bool = array_key_exists($productId, $cart);
        $count = 0;
        if ($bool) {
            $count = $cart[$productId];
        }
        return $count;
    }

    public function deleteProduct(int $productId, int $quantity): void
    {
        $cart = $this->get();
        $count = $this->checkProductCountInCart($productId, $cart);
        if ($count > $quantity) {
            $cart[$productId] = $count - $quantity;
        } else {
            unset($cart[$productId]);
        }
        Cache::put('cart_' . $this->userId, $cart, 2 * 60 * 60 * 24);
        if (!count($cart)) Cache::forget('cart_' . $this->userId);
    }
}
