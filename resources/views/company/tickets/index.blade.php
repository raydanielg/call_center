@extends('layouts.dashboard')
@section('title', 'Tickets - Company')
@section('page_title', 'Tickets')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">All Tickets</h2>
    <a href="{{ route('company.tickets.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Ticket
    </a>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Ticket #</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Subject</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Assigned To</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Priority</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Created</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3"><a href="{{ route('company.tickets.show', $ticket) }}" class="font-medium text-primary-600 hover:text-primary-700">{{ $ticket->ticket_number }}</a></td>
                    <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $ticket->subject }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $ticket->assignedTo->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-700' : ($ticket->priority === 'high' ? 'bg-amber-100 text-amber-700' : ($ticket->priority === 'medium' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-500')) }}">{{ ucfirst($ticket->priority) }}</span></td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->status === 'open' ? 'bg-blue-100 text-blue-700' : ($ticket->status === 'in_progress' ? 'bg-amber-100 text-amber-700' : ($ticket->status === 'resolved' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500')) }}">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $ticket->created_at->format('M d, Y') }}</td>
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
