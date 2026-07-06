<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
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

        $subscription = $tenant->subscription;

        if (!$subscription || !$subscription->isActive()) {
            if (!$request->routeIs('billing.*') && !$request->routeIs('logout')) {
                return redirect()->route('billing.expired')
                    ->with('error', 'Your subscription has expired. Please renew to continue.');
            }
        }

        return $next($request);
    }
}
