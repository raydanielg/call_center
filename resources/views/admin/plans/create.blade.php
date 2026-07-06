@extends('layouts.dashboard')
@section('title', 'Create Plan - Admin')
@section('page_title', 'Create Plan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.plans.index') }}" class="text-sm text-primary-600 hover:text-primary-700 mb-2 inline-block">&larr; Back to Plans</a>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.plans.store') }}">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Price (TZS)</label>
                <input type="number" name="price" value="{{ old('price', 0) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Billing Cycle</label>
                <select name="billing_cycle" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Max Agents</label>
                <input type="number" name="max_agents" value="{{ old('max_agents', 5) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Max Calls/Month</label>
                <input type="number" name="max_calls_per_month" value="{{ old('max_calls_per_month', 1000) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Storage (MB)</label>
                <input type="number" name="max_storage_mb" value="{{ old('max_storage_mb', 1024) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" checked class="rounded">
                <span class="text-sm text-gray-700 dash-text-strong">Active</span>
            </label>
        </div>
        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Create Plan</button>
        </div>
    </form>
</div>
@endsection
