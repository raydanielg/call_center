@extends('layouts.dashboard')
@section('title', 'Supervisor Dashboard')
@section('page_title', 'Supervisor Dashboard')

@section('content')
<div class="mb-6 bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-1">Supervisor Dashboard</h2>
        <p class="text-primary-100 text-sm">Monitor your team in real-time.</p>
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Calls Today', 'value' => $stats['callsToday'], 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Agents Online', 'value' => $stats['agentsOnline'], 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'On Call', 'value' => $stats['agentsOnCall'], 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Open Tickets', 'value' => $stats['openTickets'], 'color' => 'red', 'iconHtml' => '<svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 0v2m0-2h-2m2 0h2M9 5v2m0 0v2m0-2H7m2 0h2m5-4H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>'])
</div>

<div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Agent Status</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Agent</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Status</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Calls Today</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($agents as $agent)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $agent->name }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $agent->agent_status === 'available' ? 'bg-green-100 text-green-700' : ($agent->agent_status === 'on_call' ? 'bg-amber-100 text-amber-700' : ($agent->agent_status === 'break' ? 'bg-violet-100 text-violet-700' : 'bg-gray-100 text-gray-500')) }}">{{ ucfirst(str_replace('_', ' ', $agent->agent_status)) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $agent->calls_count }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-8 text-gray-400">No agents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
