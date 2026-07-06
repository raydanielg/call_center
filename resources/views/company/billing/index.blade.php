@extends('layouts.dashboard')
@section('title', 'Billing - Company')
@section('page_title', 'Billing')

@section('content')
<div class="mb-6"><h2 class="text-lg font-bold text-gray-900 dark:text-white">Billing & Subscription</h2></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Current Plan</h3>
        @if($subscription && $subscription->plan)
        <p class="text-2xl font-bold text-primary-600">{{ $subscription->plan->name }}</p>
        <p class="text-sm text-gray-400 mt-1">TZS {{ number_format($subscription->plan->price) }}/{{ $subscription->plan->billing_cycle === 'monthly' ? 'mo' : 'yr' }}</p>
        <p class="text-xs text-gray-400 mt-2">Status: <span class="{{ $subscription->status === 'active' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($subscription->status) }}</span></p>
        <p class="text-xs text-gray-400">Ends: {{ $subscription->ends_at?->format('M d, Y') ?? 'N/A' }}</p>
        @else
        <p class="text-sm text-gray-400">No active subscription.</p>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Available Plans</h3>
        <div class="space-y-2">
            @foreach($plans as $plan)
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-700 dash-text-strong">{{ $plan->name }}</span>
                <span class="text-gray-400">TZS {{ number_format($plan->price) }}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Total Paid</h3>
        <p class="text-2xl font-bold text-green-600">TZS {{ number_format($payments->where('status', 'paid')->sum('amount')) }}</p>
    </div>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Payment History</h3>
    @if($payments->isEmpty())
    <p class="text-sm text-gray-400 text-center py-8">No payments recorded.</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Amount</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Method</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Date</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Status</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @foreach($payments as $payment)
                <tr><td class="px-4 py-2 text-gray-900 dark:text-white">TZS {{ number_format($payment->amount) }}</td><td class="px-4 py-2 text-gray-500 dash-text">{{ ucfirst($payment->payment_method) }}</td><td class="px-4 py-2 text-gray-500 dash-text">{{ $payment->created_at->format('M d, Y') }}</td><td class="px-4 py-2"><span class="text-xs px-2 py-0.5 rounded-full {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($payment->status) }}</span></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
{{ $payments->withQueryString()->links() }}
@endsection
