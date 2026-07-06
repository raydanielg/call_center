<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalTenants' => Tenant::count(),
            'activeTenants' => Tenant::where('status', 'active')->count(),
            'pendingTenants' => Tenant::where('status', 'pending')->count(),
            'suspendedTenants' => Tenant::where('status', 'suspended')->count(),
            'totalRevenue' => Payment::where('status', 'paid')->sum('amount'),
            'totalUsers' => User::count(),
            'activeSubscriptions' => Subscription::where('status', 'active')->count(),
            'totalPlans' => Plan::count(),
        ];

        $recentTenants = Tenant::latest()->take(5)->get();
        $recentPayments = Payment::with('tenant')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentTenants', 'recentPayments'));
    }
}
