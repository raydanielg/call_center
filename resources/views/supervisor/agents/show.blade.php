@extends('layouts.dashboard')
@section('title', $agent->name)
@section('page_title', $agent->name)

@section('content')
<div class="mb-6"><a href="{{ route('supervisor.agents.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Agents</a></div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Recent Calls</h3>
        @if($agent->calls->isEmpty())
        <p class="text-sm text-gray-400">No calls recorded.</p>
        @else
        <div class="space-y-3">
            @foreach($agent->calls->take(10) as $call)
            <div class="flex items-center justify-between text-sm">
                <div><p class="font-medium text-gray-900 dark:text-white">{{ $call->contact->name ?? $call->phone_number }}</p><p class="text-xs text-gray-400">{{ $call->created_at->format('M d, Y H:i') }}</p></div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $call->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($call->status) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Assigned Tickets</h3>
        @if($agent->ticketsAssigned->isEmpty())
        <p class="text-sm text-gray-400">No tickets assigned.</p>
        @else
        <div class="space-y-3">
            @foreach($agent->ticketsAssigned->take(10) as $ticket)
            <div class="flex items-center justify-between text-sm">
                <div><p class="font-medium text-gray-900 dark:text-white">{{ $ticket->ticket_number }}</p><p class="text-xs text-gray-400">{{ $ticket->subject }}</p></div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">{{ ucfirst($ticket->status) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
