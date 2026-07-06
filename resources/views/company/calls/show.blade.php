@extends('layouts.dashboard')
@section('title', 'Call Details')
@section('page_title', 'Call Details')

@section('content')
<div class="mb-6"><a href="{{ route('company.calls.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Calls</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="dash-card lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Call Information</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><p class="text-xs text-gray-400">Phone Number</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->phone_number }}</p></div>
            <div><p class="text-xs text-gray-400">Direction</p><p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($call->direction) }}</p></div>
            <div><p class="text-xs text-gray-400">Contact</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->contact->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Agent</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->agent->name ?? 'Unassigned' }}</p></div>
            <div><p class="text-xs text-gray-400">Queue</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->queue->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Disposition</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->disposition->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Duration</p><p class="font-medium text-gray-900 dark:text-white">{{ gmdate('i:s', $call->duration) }}</p></div>
            <div><p class="text-xs text-gray-400">Wait Time</p><p class="font-medium text-gray-900 dark:text-white">{{ gmdate('i:s', $call->wait_time) }}</p></div>
            <div><p class="text-xs text-gray-400">Status</p><span class="text-xs px-2 py-0.5 rounded-full {{ $call->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($call->status) }}</span></div>
            <div><p class="text-xs text-gray-400">Started</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->started_at?->format('M d, Y H:i') ?? 'N/A' }}</p></div>
        </div>
        @if($call->notes)
        <div class="mt-4 pt-4 border-t border-gray-100 dash-border">
            <p class="text-xs text-gray-400 mb-1">Notes</p>
            <p class="text-sm text-gray-600 dash-text">{{ $call->notes }}</p>
        </div>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Recording</h3>
        @if($call->recording_url)
        <audio controls class="w-full"><source src="{{ $call->recording_url }}" type="audio/mpeg"></audio>
        @else
        <p class="text-sm text-gray-400">No recording available.</p>
        @endif
        @if($call->evaluation)
        <div class="mt-4 pt-4 border-t border-gray-100 dash-border">
            <p class="text-xs text-gray-400 mb-1">QA Score</p>
            <p class="text-lg font-bold text-primary-600">{{ $call->evaluation->total_score }}/100</p>
        </div>
        @endif
    </div>
</div>
@endsection
