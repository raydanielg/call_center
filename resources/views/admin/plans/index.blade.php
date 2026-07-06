@extends('layouts.dashboard')
@section('title', 'Plans - Admin')
@section('page_title', 'Plans')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">All Plans</h2>
    <a href="{{ route('admin.plans.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Plan
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($plans as $plan)
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-start justify-between mb-3">
            <div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $plan->name }}</h3>
                <p class="text-sm text-gray-400">{{ ucfirst($plan->billing_cycle) }}</p>
            </div>
            <span class="text-xs px-2 py-0.5 rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span>
        </div>
        <p class="text-2xl font-bold text-primary-600 mb-3">TZS {{ number_format($plan->price) }}<span class="text-sm font-normal text-gray-400">/{{ $plan->billing_cycle === 'monthly' ? 'mo' : 'yr' }}</span></p>
        <div class="space-y-1.5 text-sm text-gray-500 dash-text">
            <p>Max Agents: <span class="font-medium text-gray-900 dark:text-white">{{ $plan->max_agents }}</span></p>
            <p>Max Calls/Month: <span class="font-medium text-gray-900 dark:text-white">{{ number_format($plan->max_calls_per_month) }}</span></p>
            <p>Storage: <span class="font-medium text-gray-900 dark:text-white">{{ $plan->max_storage_mb }} MB</span></p>
        </div>
        <div class="flex gap-2 mt-4">
            <a href="{{ route('admin.plans.edit', $plan) }}" class="flex-1 text-center px-3 py-1.5 text-xs font-medium border border-gray-200 dash-border rounded-lg hover:bg-gray-50 dash-hover text-gray-600 dash-text-strong">Edit</a>
            <form method="POST" action="{{ route('admin.plans.destroy', $plan) }}" class="inline" onsubmit="return confirm('Delete this plan?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1.5 text-xs font-medium border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No plans created yet.</div>
    @endforelse
</div>
{{ $plans->withQueryString()->links() }}
@endsection
