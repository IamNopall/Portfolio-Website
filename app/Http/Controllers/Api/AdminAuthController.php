<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    /**
     * Verify PIN against hashed database record for Admin Access.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'pin' => 'required|string',
        ]);

        // Retrieve or auto-seed admin access record
        $adminAccess = AdminAccess::firstOrCreate(
            ['key' => 'admin_pin'],
            [
                'pin_hash' => Hash::make(env('ADMIN_PIN', '20032005')),
            ]
        );

        // Secure password hash verification
        if (Hash::check($request->pin, $adminAccess->pin_hash)) {
            // Update last login metrics
            $adminAccess->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            // Generate a secure session token
            $sessionPayload = Str::random(40) . '_' . time();
            $token = hash('sha256', $sessionPayload . '_admin_secret_token_session');

            return response()->json([
                'success' => true,
                'message' => 'Access granted.',
                'token' => $token,
                'last_login' => $adminAccess->last_login_at ? $adminAccess->last_login_at->toIso8601String() : null,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid Security PIN. Access denied.',
        ], 401);
    }

    /**
     * Update/Change Admin Security PIN in database.
     */
    public function updatePin(Request $request): JsonResponse
    {
        $request->validate([
            'current_pin' => 'required|string',
            'new_pin' => 'required|string|min:4|max:32',
        ]);

        $adminAccess = AdminAccess::where('key', 'admin_pin')->first();

        if (!$adminAccess || !Hash::check($request->current_pin, $adminAccess->pin_hash)) {
            return response()->json([
                'success' => false,
                'message' => 'Current PIN does not match records.',
            ], 403);
        }

        $adminAccess->update([
            'pin_hash' => Hash::make($request->new_pin),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin Security PIN updated successfully.',
        ]);
    }
}
