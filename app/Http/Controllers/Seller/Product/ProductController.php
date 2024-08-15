<?php

namespace App\Http\Controllers\Seller\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Product\StoreRequest;
use App\Http\Requests\Seller\Product\updateRequest;
use App\Http\Resources\Seller\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $product = $seller->products()->create($data);
        return response()->json(['message' => 'ok', 'data' => ProductResource::make($product)], 201);
    }


    public function update(updateRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $product->update($data);
        return response()->json(['message' => 'ok', 'data' => 'update successfully']);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['message' => 'ok', 'data' => 'delete successfully']);
    }
}
