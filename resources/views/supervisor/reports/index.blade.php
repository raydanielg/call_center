@extends('layouts.dashboard')
@section('title', 'Reports - Supervisor')
@section('page_title', 'Reports')

@section('content')
<div class="mb-6"><h2 class="text-lg font-bold text-gray-900 dark:text-white">Performance Reports</h2></div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Calls by Day ({{ now()->format('F') }})</h3>
        <div class="space-y-2">
            @foreach($callsByDay as $date => $count)
            <div class="flex items-center gap-3"><span class="text-xs text-gray-400 w-20">{{ \Carbon\Carbon::parse($date)->format('M d') }}</span><div class="flex-1 bg-gray-100 dash-bg-subtle rounded-full h-5 overflow-hidden"><div class="bg-primary-500 h-full rounded-full flex items-center justify-end px-2" style="width: {{ min(100, max(5, ($count / max(1, max($callsByDay))) * 100)) }}%"><span class="text-xs text-white font-medium">{{ $count }}</span></div></div></div>
            @endforeach
            @if(empty($callsByDay))<p class="text-sm text-gray-400 text-center py-4">No data.</p>@endif
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Agent Performance</h3>
        <div class="space-y-3">
            @foreach($agentPerformance as $agent)
            <div class="flex items-center justify-between text-sm">
                <div><p class="font-medium text-gray-900 dark:text-white">{{ $agent->name }}</p><p class="text-xs text-gray-400">Avg duration: {{ gmdate('i:s', $agent->avg_call_duration) }}</p></div>
                <div class="text-right"><p class="font-bold text-gray-900 dark:text-white">{{ $agent->calls_count }}</p><p class="text-xs text-gray-400">calls</p></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
