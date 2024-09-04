<?php

namespace App\Http\Controllers\Seller\Product;

use App\Events\OrderStatusChangeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Product\AddDiscountRequest;
use App\Http\Requests\Seller\Product\StoreRequest;
use App\Http\Requests\Seller\Product\updateRequest;
use App\Http\Resources\Seller\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Policies\Seller\Product\DiscountPolicy;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json(['message' => 'ok', 'data' => ProductResource::collection($products)]);
    }


    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $seller = Auth::guard('seller')->user();
        if ($request->hasFile('image')) {
            $file = new FileService($data['image']);
            $file->upload('products');
            $data['image'] = $file->getPath();
        }
        $product = $seller->products()->create($data);
        return response()->json(['message' => 'ok', 'data' => ProductResource::make($product)], 201);
    }


    public function update(updateRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists(public_path($product->image))) {
                Storage::delete(public_path($product->image));
            }
            $file = new FileService($data['image']);
            $file->upload('products');
            $data['image'] = $file->getPath();
        }
        $product->update($data);
        return response()->json(['message' => 'ok', 'data' => 'update successfully']);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['message' => 'ok', 'data' => 'delete successfully']);
    }

    public function addDiscount(AddDiscountRequest $request)
    {
        $seller = Auth::guard('seller')->user();
        $data = $request->validated();
        $product = Product::find($data['product_id']);
        $seller->can('add', $product);
        $product->update(['discount_id' => $data['discount_id']]);
        return response()->json(['message' => 'ok', 'data' => 'discount added successfully']);
    }
}
