@extends('layouts.dashboard')
@section('title', 'Recording Details')
@section('page_title', 'Recording Details')

@section('content')
<div class="mb-6"><a href="{{ route('qa.recordings.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Recordings</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="dash-card lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Recording</h3>
        @if($call->recording_url)
        <audio controls class="w-full mb-4"><source src="{{ $call->recording_url }}" type="audio/mpeg"></audio>
        @else
        <p class="text-sm text-gray-400 mb-4">No recording available.</p>
        @endif
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><p class="text-xs text-gray-400">Phone</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->phone_number }}</p></div>
            <div><p class="text-xs text-gray-400">Agent</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->agent->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Contact</p><p class="font-medium text-gray-900 dark:text-white">{{ $call->contact->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Duration</p><p class="font-medium text-gray-900 dark:text-white">{{ gmdate('i:s', $call->duration) }}</p></div>
        </div>
        @if($call->evaluation)
        <div class="mt-4 pt-4 border-t border-gray-100 dash-border">
            <p class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Existing Evaluation</p>
            <p class="text-lg font-bold text-primary-600">{{ $call->evaluation->total_score }}/100</p>
            <a href="{{ route('qa.evaluations.show', $call->evaluation) }}" class="text-xs text-primary-600 hover:text-primary-700 mt-1 inline-block">View Evaluation</a>
        </div>
        @else
        <div class="mt-4 pt-4 border-t border-gray-100 dash-border">
            <a href="{{ route('qa.evaluations.create') }}" class="inline-block px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">Create Evaluation</a>
        </div>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Call Notes</h3>
        <p class="text-sm text-gray-600 dash-text">{{ $call->notes ?? 'No notes recorded for this call.' }}</p>
    </div>
</div>
@endsection
