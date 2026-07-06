@extends('layouts.dashboard')
@section('title', 'Tickets - Supervisor')
@section('page_title', 'Tickets')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Ticket #</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Subject</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Assigned To</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Priority</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th><th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Assign</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-primary-600">{{ $ticket->ticket_number }}</td>
                    <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $ticket->subject }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $ticket->assignedTo->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($ticket->priority) }}</span></td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">{{ ucfirst($ticket->status) }}</span></td>
                    <td class="px-4 py-3 text-right">
                        <form method="POST" action="{{ route('supervisor.tickets.assign', $ticket) }}">@csrf @method('PUT')
                            <select name="assigned_to" onchange="this.form.submit()" class="text-xs border border-gray-200 dash-border rounded-lg px-2 py-1 dash-input">
                                <option value="">Assign...</option>
                                @foreach($agents as $agent)<option value="{{ $agent->id }}" {{ $ticket->assigned_to === $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>@endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-12 text-gray-400">No tickets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $tickets->withQueryString()->links() }}
@endsection
