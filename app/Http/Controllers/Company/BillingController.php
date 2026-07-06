<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $tenant = auth()->user()->tenant;
        $subscription = $tenant->subscription;
        $payments = $tenant->payments()->latest()->paginate(10);
        $plans = Plan::where('is_active', true)->get();

        return view('company.billing.index', compact('tenant', 'subscription', 'payments', 'plans'));
    }

    public function expired()
    {
        return view('company.billing.expired');
    }

    public function suspended()
    {
        return view('company.billing.suspended');
    }
}
