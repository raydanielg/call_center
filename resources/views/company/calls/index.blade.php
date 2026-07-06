@extends('layouts.dashboard')
@section('title', 'Calls - Company')
@section('page_title', 'Calls')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Phone</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Contact</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Agent</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Direction</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Duration</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($calls as $call)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3"><a href="{{ route('company.calls.show', $call) }}" class="font-medium text-primary-600 hover:text-primary-700">{{ $call->phone_number }}</a></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $call->contact->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $call->agent->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-3"><span class="text-xs {{ $call->direction === 'inbound' ? 'text-green-600' : 'text-primary-600' }}">{{ ucfirst($call->direction) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ gmdate('i:s', $call->duration) }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $call->status === 'completed' ? 'bg-green-100 text-green-700' : ($call->status === 'missed' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($call->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $call->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-12 text-gray-400">No calls recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $calls->withQueryString()->links() }}
@endsection
