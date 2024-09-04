<?php

namespace App\Http\Controllers\Customer\Cart;

use App\Enum\OrderStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Events\OrderStatusChangeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\AddProductToCartRequest;
use App\Http\Requests\Customer\Cart\DeleteProductToCartRequest;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addProductToCart(AddProductToCartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cartService = new CartService(Auth::id());
        $product = Product::find($data['productId']);
        if (!$product->checkProductQuantity($data['quantity']))  return response()->json(['message' => 'not ok', 'data' => 'have nt enough quantity']);
        $cartService->addProduct($data['product_id'], $data['quantity']);
        $cart = $cartService->get();
        return response()->json(['message' => 'ok', 'data' => CartResource::make($cart)]);
    }


    public function showCart(): JsonResponse
    {
        $cart = Cache::get('cart_' . Auth::id());
        $cart = $cart ?? [];
        $data = CartResource::make($cart) ?? [];
        return response()->json(['message' => 'ok', 'data' => $data]);
    }

    public function deleteProductFromCart(DeleteProductToCartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cartService = new CartService(Auth::id());
        $cartService->deleteProduct($data['product_id'], $data['quantity']);
        $cart = $cartService->get();
        return response()->json(['message' => 'ok', 'data' => CartResource::make($cart)]);
    }

    public function pay(): JsonResponse
    {
        $cart = Cache::get('cart_' . Auth::id());
        $customer = Auth::user();

        if (!$cart) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        try {
            DB::beginTransaction();

            $totalAmount = 0;

            foreach ($cart as $productId => $quantity) {
                $product = Product::query()->find($productId);
                $totalAmount += $product->price * $quantity;
            }

            $payment = $customer->payments()->create([
                'amount' => $totalAmount,
                'status' => PaymentStatusEnum::SUCCESSFUL
            ]);

            if ($payment) {
                foreach ($cart as $productId => $quantity) {
                    $product = Product::query()->find($productId);
                    $product->update(['quantity' => $product->quantity - $quantity]);
                }
            }
            $order = $customer->orders()->create([
                'total_price' => $totalAmount,
                'status' => OrderStatusEnum::PAID,
            ]);

//            OrderStatusChangeEvent::dispatch($order);

            foreach ($cart as $productId => $quantity) {
                $product = Product::query()->find($productId);
                if (!$product) {
                    return response()->json(['message' => 'Product not found'], 400);
                }
                $order->orderItems()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ]);
            }


            DB::commit();

            Cache::forget('cart_' . Auth::id());

            return response()->json(['message' => 'Payment successful'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Payment failed', 'error' => $e->getMessage()], 500);
        }


    }
}
