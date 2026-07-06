@extends('layouts.dashboard')
@section('title', 'Live Monitor')
@section('page_title', 'Live Monitor')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Live Agent Monitor</h2>
    <span class="inline-flex items-center gap-1 text-xs text-red-600 font-medium"><span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span> LIVE</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($agents as $agent)
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-sm">{{ strtoupper(substr($agent->name, 0, 1)) }}</div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white {{ $agent->agent_status === 'available' ? 'bg-green-500' : ($agent->agent_status === 'on_call' ? 'bg-amber-500' : ($agent->agent_status === 'break' ? 'bg-violet-500' : 'bg-gray-400')) }}"></span>
                </div>
                <div><p class="text-sm font-medium text-gray-900 dark:text-white">{{ $agent->name }}</p><p class="text-xs text-gray-400">{{ ucfirst(str_replace('_', ' ', $agent->agent_status)) }}</p></div>
            </div>
        </div>
        <div class="text-xs text-gray-400 space-y-1">
            <p>Extension: {{ $agent->extension_number ?? 'N/A' }}</p>
            <p>Session started: {{ $agent->agentSessions->first()?->started_at?->diffForHumans() ?? 'Not logged in' }}</p>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No agents online.</div>
    @endforelse
</div>
@endsection
