<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // For API requests, return null (will generate 401 response)
        if ($request->expectsJson()) {
            return null;
        }

        try {
            // Store the intended URL for redirect after login
            if (!$request->is('login') && !$request->is('logout')) {
                session()->put('url.intended', $request->fullUrl());
            }

            // Verify the login route exists
            if (!Route::has('login')) {
                throw new \RuntimeException('Login route not defined');
            }

            // Add flash message for the login page
            session()->flash('auth_redirect', 'Please login to access this page');

            return route('login');
        } catch (\Exception $e) {
            // Log detailed error information
            Log::error('Authentication redirect failed', [
                'error' => $e->getMessage(),
                'url' => $request->fullUrl(),
                'ip' => $request->ip()
            ]);

            // Fallback to a basic error message
            abort(500, 'Authentication system error. Please check application logs.');
        }
    }
}
