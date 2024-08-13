<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    }

    public function guard(): string
    {
        if (Admin::where('email', request()->email)->exists()) {
            return 'admin';
        } elseif (Seller::where('email', request()->email)->exists()) {
            return 'seller';
        } else {
            return 'customer';
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->validateLogin($request);
        $guardName = $this->guard();
        $guard = Auth::guard($guardName);
        $model = match ($guardName) {
            'seller' => Seller::class,
            'admin' => Admin::class,
            'customer' => Customer::class
        };
        $user = $model::query()->where('email', request()->email)->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken($guardName . '-token', [$guardName])->plainTextToken;
            return response()->json(['token' => $token, $guardName => $user]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);

    }
}
