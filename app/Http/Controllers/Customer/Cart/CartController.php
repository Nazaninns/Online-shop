<?php

namespace App\Http\Controllers\Customer\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\AddProductToCartRequest;
use App\Http\Requests\Customer\Cart\DeleteProductToCartRequest;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function addProductToCart(AddProductToCartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cartService = new CartService($request->user()->id);
        $cartService->addProduct($data['product_id'], $data['quantity']);
        $cart = $cartService->get();
        return response()->json(['message' => 'ok', 'data' => CartResource::make($cart)]);
    }


    public function showCart(): JsonResponse
    {
        $cart = Cache::get('cart_' . Auth::id());
        $data = CartResource::make($cart) ?? [];
        return response()->json(['message' => 'ok', 'data' => $data]);
    }

    public function deleteProductFromCart(DeleteProductToCartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cartService = new CartService($request->user()->id);
        $cartService->deleteProduct($data['product_id'], $data['quantity']);
        $cart = $cartService->get();
        return response()->json(['message' => 'ok', 'data' => CartResource::make($cart)]);
    }
}
