@extends('layouts.dashboard')
@section('title', 'Dashboard - Company')
@section('page_title', 'Dashboard')

@section('content')
<div class="mb-6 bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 right-20 w-24 h-24 bg-white/5 rounded-full -mb-12"></div>
    <div class="relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-1">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-primary-100 text-sm">Here's what's happening in your call center today.</p>
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Calls Today', 'value' => $stats['callsToday'], 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Open Tickets', 'value' => $stats['openTickets'], 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 0v2m0-2h-2m2 0h2M9 5v2m0 0v2m0-2H7m2 0h2m5-4H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Active Agents', 'value' => $stats['activeAgents'], 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Total Contacts', 'value' => $stats['totalContacts'], 'color' => 'violet', 'iconHtml' => '<svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>'])
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Calls</h3>
            <a href="{{ route('company.calls.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700">View All</a>
        </div>
        @if($recentCalls->isEmpty())
        <div class="text-center py-8 text-sm text-gray-400">No calls recorded yet.</div>
        @else
        <div class="space-y-3">
            @foreach($recentCalls as $call)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg {{ $call->direction === 'inbound' ? 'bg-green-100 text-green-600' : 'bg-primary-100 text-primary-600' }} flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $call->contact->name ?? $call->phone_number }}</p>
                        <p class="text-xs text-gray-400">{{ $call->agent->name ?? 'Unassigned' }} | {{ $call->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $call->status === 'completed' ? 'bg-green-100 text-green-700' : ($call->status === 'missed' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($call->status) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Tickets</h3>
            <a href="{{ route('company.tickets.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700">View All</a>
        </div>
        @if($recentTickets->isEmpty())
        <div class="text-center py-8 text-sm text-gray-400">No tickets created yet.</div>
        @else
        <div class="space-y-3">
            @foreach($recentTickets as $ticket)
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->ticket_number }}</p>
                    <p class="text-xs text-gray-400">{{ $ticket->subject }}</p>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-700' : ($ticket->priority === 'high' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-500') }}">{{ ucfirst($ticket->priority) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
