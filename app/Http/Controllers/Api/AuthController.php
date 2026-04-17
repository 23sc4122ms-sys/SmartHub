<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'device_name' => ['nullable', 'string', 'max:120'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $deviceName = isset($data['device_name']) && $data['device_name'] !== ''
            ? $data['device_name']
            : 'desktop-app';

        $token = $user->createToken($deviceName)->plainTextToken;

        return response()->json([
            'ok' => true,
            'message' => 'Registration successful.',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:120'],
        ]);

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $deviceName = isset($data['device_name']) && $data['device_name'] !== ''
            ? $data['device_name']
            : 'desktop-app';

        $user->tokens()->where('name', $deviceName)->delete();
        $token = $user->createToken($deviceName)->plainTextToken;

        return response()->json([
            'ok' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        return response()->json([
            'ok' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user?->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'ok' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
}
