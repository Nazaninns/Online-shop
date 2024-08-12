<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validated(Request $request): array
    {
        return $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email', 'unique:sellers,email', 'unique:customers,email'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['required', 'string', Rule::in(['admin', 'seller', 'customer'])],
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        $data = $this->validated($request);
        $validatedData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ];
        $user = match ($data['type']) {
            'admin' => Admin::query()->create($validatedData),
            'seller' => Seller::query()->create($validatedData),
            'customer' => Customer::query()->create($validatedData),
            default => throw new InvalidArgumentException("Invalid user type: {$data['type']}"),
        };
        return response(['message' => 'user registered', 'email' => $user->email], ResponseAlias::HTTP_CREATED);
    }
}
