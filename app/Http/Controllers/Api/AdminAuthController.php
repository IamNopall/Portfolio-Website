<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Verify PIN / Password for Admin Access.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'pin' => 'required|string',
        ]);

        $validPin = env('ADMIN_PIN', '123456');

        if ($request->pin === $validPin) {
            $token = hash('sha256', $validPin . '_admin_secret_token_session');
            return response()->json([
                'success' => true,
                'message' => 'Access granted.',
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid Security PIN. Access denied.',
        ], 401);
    }
}
