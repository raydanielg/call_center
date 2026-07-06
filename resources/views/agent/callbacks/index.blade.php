@extends('layouts.dashboard')
@section('title', 'My Callbacks')
@section('page_title', 'Callbacks')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Contact</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Phone</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Scheduled</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th><th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Action</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($callbacks as $cb)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $cb->contact->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $cb->contact->phone ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $cb->scheduled_at->format('M d, Y H:i') }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $cb->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($cb->status === 'done' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($cb->status) }}</span></td>
                    <td class="px-4 py-3 text-right">
                        @if($cb->status === 'pending')
                        <form method="POST" action="{{ route('agent.callbacks.status', $cb) }}" class="inline">@csrf @method('PUT')
                            <button name="status" value="done" class="text-xs text-green-600 hover:text-green-700 mr-2">Mark Done</button>
                            <button name="status" value="missed" class="text-xs text-red-600 hover:text-red-700">Mark Missed</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No callbacks scheduled.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $callbacks->withQueryString()->links() }}
@endsection
