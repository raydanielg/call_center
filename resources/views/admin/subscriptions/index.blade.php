@extends('layouts.dashboard')
@section('title', 'Subscriptions - Admin')
@section('page_title', 'Subscriptions')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Company</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Plan</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Start Date</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">End Date</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($subscriptions as $sub)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $sub->tenant->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $sub->plan->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $sub->starts_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $sub->ends_at?->format('M d, Y') ?? 'N/A' }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : ($sub->status === 'expired' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-500') }}">{{ ucfirst($sub->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No subscriptions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $subscriptions->withQueryString()->links() }}
@endsection
