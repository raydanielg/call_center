<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenantActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || $user->hasRole('super_admin')) {
            return $next($request);
        }

        $tenant = $user->tenant;

        if (!$tenant) {
            return $next($request);
        }

        if ($tenant->status === 'suspended') {
            return redirect()->route('billing.suspended')
                ->with('error', 'Your account is suspended. Please contact support.');
        }

        return $next($request);
    }
}
