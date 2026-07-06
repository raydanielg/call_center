@extends('layouts.dashboard')
@section('title', 'Queues - Company')
@section('page_title', 'Queues')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Call Queues</h2>
    <a href="{{ route('company.queues.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Queue
    </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse($queues as $queue)
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-start justify-between mb-3">
            <div><h3 class="text-sm font-bold text-gray-900 dark:text-white">{{ $queue->name }}</h3><p class="text-xs text-gray-400">{{ ucfirst(str_replace('_', ' ', $queue->strategy)) }}</p></div>
            <span class="text-xs px-2 py-0.5 rounded-full {{ $queue->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $queue->is_active ? 'Active' : 'Inactive' }}</span>
        </div>
        <p class="text-sm text-gray-500 dash-text mb-3">{{ $queue->description ?? 'No description' }}</p>
        <div class="text-xs text-gray-400 mb-3">Agents: {{ $queue->agents->count() }} | Max Wait: {{ $queue->max_wait_time }}s</div>
        <div class="flex gap-2">
            <a href="{{ route('company.queues.edit', $queue) }}" class="flex-1 text-center px-3 py-1.5 text-xs font-medium border border-gray-200 dash-border rounded-lg hover:bg-gray-50 dash-hover text-gray-600 dash-text-strong">Edit</a>
            <form method="POST" action="{{ route('company.queues.destroy', $queue) }}" class="inline" onsubmit="return confirm('Delete queue?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-medium border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No queues created yet.</div>
    @endforelse
</div>
{{ $queues->withQueryString()->links() }}
@endsection
