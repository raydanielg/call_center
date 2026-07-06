@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')
@section('page_title', 'Super Admin Dashboard')

@section('content')
{{-- Welcome Banner --}}
<div class="mb-6 bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -mr-24 -mt-24"></div>
    <div class="absolute bottom-0 right-32 w-24 h-24 bg-white/5 rounded-full -mb-12"></div>
    <div class="relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-1">Super Admin Dashboard</h2>
        <p class="text-primary-100 text-sm">Manage all companies, plans, and payments across the platform.</p>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Total Companies', 'value' => $stats['totalTenants'], 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>'])
    @include('partials.stat-card', ['label' => 'Active Companies', 'value' => $stats['activeTenants'], 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Total Revenue', 'value' => 'TZS ' . number_format($stats['totalRevenue']), 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8"/></svg>'])
    @include('partials.stat-card', ['label' => 'Active Subscriptions', 'value' => $stats['activeSubscriptions'], 'color' => 'violet', 'iconHtml' => '<svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>'])
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    {{-- Recent Companies --}}
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Companies</h3>
            <a href="{{ route('admin.companies.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700">View All</a>
        </div>
        @if($recentTenants->isEmpty())
        <div class="text-center py-8 text-sm text-gray-400">No companies registered yet.</div>
        @else
        <div class="space-y-3">
            @foreach($recentTenants as $tenant)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-xs">
                        {{ strtoupper(substr($tenant->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $tenant->name }}</p>
                        <p class="text-xs text-gray-400">{{ $tenant->email }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $tenant->status === 'active' ? 'bg-green-100 text-green-700' : ($tenant->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($tenant->status) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Recent Payments --}}
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Payments</h3>
            <a href="{{ route('admin.payments.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700">View All</a>
        </div>
        @if($recentPayments->isEmpty())
        <div class="text-center py-8 text-sm text-gray-400">No payments recorded yet.</div>
        @else
        <div class="space-y-3">
            @foreach($recentPayments as $payment)
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->tenant->name ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-400">{{ $payment->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900 dark:text-white">TZS {{ number_format($payment->amount) }}</p>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' : ($payment->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($payment->status) }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
