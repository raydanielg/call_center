@extends('layouts.dashboard')
@section('title', $ticket->ticket_number)
@section('page_title', $ticket->ticket_number)

@section('content')
<div class="mb-6"><a href="{{ route('agent.tickets.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Tickets</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="dash-card lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
        <div class="flex items-start justify-between mb-4">
            <div><h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $ticket->subject }}</h2><p class="text-xs text-gray-400 mt-1">{{ $ticket->ticket_number }}</p></div>
            <form method="POST" action="{{ route('agent.tickets.status', $ticket) }}">@csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-200 dash-border rounded-lg px-2 py-1 dash-input">
                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </form>
        </div>
        <p class="text-sm text-gray-600 dash-text mb-4">{{ $ticket->description }}</p>
        <div class="border-t border-gray-100 dash-border pt-4">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Replies</h3>
            @if($ticket->replies->isEmpty())<p class="text-sm text-gray-400 mb-4">No replies yet.</p>@else
            <div class="space-y-3 mb-4">
                @foreach($ticket->replies as $reply)
                <div class="bg-gray-50 dash-bg-subtle rounded-lg p-3"><div class="flex items-center justify-between mb-1"><span class="text-xs font-medium text-gray-900 dark:text-white">{{ $reply->user->name }}</span><span class="text-xs text-gray-400">{{ $reply->created_at->format('M d, H:i') }}</span></div><p class="text-sm text-gray-600 dash-text">{{ $reply->message }}</p></div>
                @endforeach
            </div>
            @endif
            <form method="POST" action="{{ route('agent.tickets.reply', $ticket) }}">@csrf
                <textarea name="message" rows="3" placeholder="Type your reply..." class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></textarea>
                <div class="flex items-center gap-4 mt-2">
                    <label class="flex items-center gap-2"><input type="checkbox" name="is_internal_note" class="rounded"> <span class="text-xs text-gray-600 dash-text">Internal Note</span></label>
                    <button type="submit" class="ml-auto px-4 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-medium rounded-lg">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Details</h3>
        <div class="space-y-3 text-sm">
            <div><p class="text-xs text-gray-400">Contact</p><p class="font-medium text-gray-900 dark:text-white">{{ $ticket->contact->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Priority</p><span class="text-xs px-2 py-0.5 rounded-full {{ $ticket->priority === 'urgent' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($ticket->priority) }}</span></div>
            <div><p class="text-xs text-gray-400">Category</p><p class="font-medium text-gray-900 dark:text-white">{{ $ticket->category ?? 'N/A' }}</p></div>
            @if($ticket->sla_due_at)<div><p class="text-xs text-gray-400">SLA Due</p><p class="font-medium {{ $ticket->sla_due_at->isPast() ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">{{ $ticket->sla_due_at->format('M d, Y H:i') }}</p></div>@endif
        </div>
    </div>
</div>
@endsection
