@extends('layouts.dashboard')
@section('title', 'Reports - Company')
@section('page_title', 'Reports')

@section('content')
<div class="mb-6"><h2 class="text-lg font-bold text-gray-900 dark:text-white">Call Center Reports</h2></div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Calls by Day ({{ now()->format('F') }})</h3>
        <div class="space-y-2">
            @foreach($callsByDay as $date => $count)
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-400 w-20">{{ \Carbon\Carbon::parse($date)->format('M d') }}</span>
                <div class="flex-1 bg-gray-100 dash-bg-subtle rounded-full h-5 overflow-hidden">
                    <div class="bg-primary-500 h-full rounded-full flex items-center justify-end px-2" style="width: {{ min(100, max(5, ($count / max(1, max($callsByDay))) * 100)) }}%"><span class="text-xs text-white font-medium">{{ $count }}</span></div>
                </div>
            </div>
            @endforeach
            @if(empty($callsByDay))<p class="text-sm text-gray-400 text-center py-4">No data for this month.</p>@endif
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Tickets by Status</h3>
        <div class="space-y-3">
            @foreach($ticketsByStatus as $status => $count)
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 dash-text-strong">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $count }}</span>
            </div>
            @endforeach
            @if(empty($ticketsByStatus))<p class="text-sm text-gray-400 text-center py-4">No tickets yet.</p>@endif
        </div>
    </div>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Agent Performance</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Agent</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Calls This Month</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($agentPerformance as $agent)
                <tr><td class="px-4 py-2 font-medium text-gray-900 dark:text-white">{{ $agent->name }}</td><td class="px-4 py-3 text-gray-500 dash-text">{{ $agent->calls_count }}</td></tr>
                @empty
                <tr><td colspan="2" class="text-center py-8 text-gray-400">No agents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
