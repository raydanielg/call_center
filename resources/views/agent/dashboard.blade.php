@extends('layouts.dashboard')
@section('title', 'Agent Dashboard')
@section('page_title', 'My Dashboard')

@section('content')
<div class="mb-6 bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-1">Welcome, {{ auth()->user()->name }}!</h2>
        <p class="text-primary-100 text-sm">You have {{ $stats['myOpenTickets'] }} open tickets and {{ $stats['pendingCallbacks'] }} pending callbacks.</p>
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Calls Today', 'value' => $stats['myCallsToday'], 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Open Tickets', 'value' => $stats['myOpenTickets'], 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 0v2m0-2h-2m2 0h2M9 5v2m0 0v2m0-2H7m2 0h2m5-4H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Pending Callbacks', 'value' => $stats['pendingCallbacks'], 'color' => 'red', 'iconHtml' => '<svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Total Calls', 'value' => $stats['myTotalCalls'], 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'])
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4"><h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Calls</h3><a href="{{ route('agent.calls.index') }}" class="text-xs text-primary-600">View All</a></div>
        @if($recentCalls->isEmpty())<p class="text-sm text-gray-400 text-center py-8">No calls yet.</p>@else
        <div class="space-y-3">
            @foreach($recentCalls as $call)
            <div class="flex items-center justify-between"><div><p class="text-sm font-medium text-gray-900 dark:text-white">{{ $call->contact->name ?? $call->phone_number }}</p><p class="text-xs text-gray-400">{{ $call->created_at->diffForHumans() }}</p></div><span class="text-xs px-2 py-0.5 rounded-full {{ $call->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($call->status) }}</span></div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4"><h3 class="text-sm font-semibold text-gray-900 dark:text-white">Upcoming Callbacks</h3><a href="{{ route('agent.callbacks.index') }}" class="text-xs text-primary-600">View All</a></div>
        @if($upcomingCallbacks->isEmpty())<p class="text-sm text-gray-400 text-center py-8">No pending callbacks.</p>@else
        <div class="space-y-3">
            @foreach($upcomingCallbacks as $cb)
            <div class="flex items-center justify-between"><div><p class="text-sm font-medium text-gray-900 dark:text-white">{{ $cb->contact->name ?? $cb->contact->phone }}</p><p class="text-xs text-gray-400">{{ $cb->scheduled_at->format('M d, Y H:i') }}</p></div></div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
