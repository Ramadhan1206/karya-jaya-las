<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ===== CEK APAKAH USER SUDAH LOGIN =====
        if (!Auth::check()) {
            Log::warning('User access denied: User not logged in', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // ===== CEK APAKAH USER MEMILIKI ROLE USER ATAU ADMIN =====
        // Admin juga diizinkan mengakses halaman user
        if (Auth::user()->role !== 'user' && Auth::user()->role !== 'admin') {
            Log::warning('User access denied: Invalid role', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email,
                'user_role' => Auth::user()->role,
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak.',
                    'code' => 403
                ], 403);
            }
            
            return redirect()->route('home')
                ->with('error', 'Akses ditolak.');
        }

        // ===== LOG AKTIVITAS USER =====
        Log::info('User access granted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip()
        ]);

        return $next($request);
    }
}