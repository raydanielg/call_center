<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $monthlyRevenue = Payment::where('status', 'paid')
            ->selectRaw('MONTH(paid_at) as month, SUM(amount) as total')
            ->whereYear('paid_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $tenantGrowth = Tenant::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.reports.index', compact('monthlyRevenue', 'tenantGrowth'));
    }
}
