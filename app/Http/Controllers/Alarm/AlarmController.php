<?php

namespace App\Http\Controllers\Alarm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alarm\StoreRequest;
use App\Models\Alarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlarmController extends Controller
{
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $customer = Auth::guard('customer')->user();
        $customer->alarms()->create($validated);
        return response()->json(['message' => 'ok', 'data' => 'Alarm created successfully.']);
    }

    public function destroy(StoreRequest $request)
    {
        $validated = $request->validated();
        $customer = Auth::guard('customer')->user();
        $customer->alarms()->where('product_id', $validated['product_id'])->delete();
        return response()->json(['message' => 'ok', 'data' => 'Alarm deleted successfully.']);
    }
}
