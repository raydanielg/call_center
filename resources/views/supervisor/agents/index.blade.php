@extends('layouts.dashboard')
@section('title', 'Agents - Supervisor')
@section('page_title', 'Agents')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Agent</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Total Calls</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Assigned Tickets</th><th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Actions</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($agents as $agent)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $agent->name }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $agent->agent_status === 'available' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst(str_replace('_', ' ', $agent->agent_status)) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $agent->calls_count }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $agent->tickets_assigned_count }}</td>
                    <td class="px-4 py-3 text-right"><a href="{{ route('supervisor.agents.show', $agent) }}" class="text-xs text-primary-600 hover:text-primary-700">View Details</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No agents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $agents->withQueryString()->links() }}
@endsection
