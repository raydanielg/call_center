@extends('layouts.dashboard')
@section('title', $tenant->name . ' - Company Details')
@section('page_title', $tenant->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.companies.index') }}" class="text-sm text-primary-600 hover:text-primary-700 mb-2 inline-block">&larr; Back to Companies</a>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-lg">
                    {{ strtoupper(substr($tenant->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $tenant->name }}</h2>
                    <p class="text-sm text-gray-400">{{ $tenant->email }} | {{ $tenant->phone ?? 'N/A' }}</p>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $tenant->status === 'active' ? 'bg-green-100 text-green-700' : ($tenant->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($tenant->status) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Subscription</h3>
        @if($tenant->subscription)
        <p class="text-sm text-gray-500 dash-text">Plan: <span class="font-medium text-gray-900 dark:text-white">{{ $tenant->subscription->plan->name ?? 'N/A' }}</span></p>
        <p class="text-sm text-gray-500 dash-text mt-1">Status: <span class="font-medium {{ $tenant->subscription->status === 'active' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($tenant->subscription->status) }}</span></p>
        <p class="text-sm text-gray-500 dash-text mt-1">Ends: {{ $tenant->subscription->ends_at?->format('M d, Y') ?? 'N/A' }}</p>
        @else
        <p class="text-sm text-gray-400">No subscription</p>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Users</h3>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $tenant->users->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">Total staff members</p>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Payments</h3>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">TZS {{ number_format($tenant->payments->where('status', 'paid')->sum('amount')) }}</p>
        <p class="text-xs text-gray-400 mt-1">Total paid</p>
    </div>
</div>

<div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Staff Members</h3>
    <div class="space-y-3">
        @foreach($tenant->users as $user)
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-xs">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            <span class="text-xs text-gray-400">{{ $user->roles->first()?->name ?? 'N/A' }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
