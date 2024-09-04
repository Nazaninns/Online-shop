<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\StoreRequest;
use App\Http\Resources\Admin\Discount\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $discount = Discount::create($data);
        return response()->json(['message' => 'ok', 'data' => DiscountResource::make($discount)], 201);
    }
}
