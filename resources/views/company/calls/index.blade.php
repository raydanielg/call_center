@extends('layouts.dashboard')
@section('title', 'Calls - Company')
@section('page_title', 'Calls')

@section('content')
<div class="flex items-center justify-between mb-4">
    <p class="text-sm text-gray-400">All calls recorded across your company.</p>
    <div class="flex items-center gap-2">
        <button onclick="Dialer.openPanel()" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm font-semibold rounded-lg shadow-md shadow-green-500/20 flex items-center gap-2 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            Open Dialer
        </button>
        <a href="{{ route('company.calls.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-lg shadow-md flex items-center gap-2 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Log Call
        </a>
    </div>
</div>
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
                    <th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Actions</th>
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
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('company.calls.edit', $call) }}" class="inline-flex p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-primary-600 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button onclick="deleteCall({{ $call->id }})" class="inline-flex p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 transition-colors" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-12 text-gray-400">No calls recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $calls->withQueryString()->links() }}

<script>
function deleteCall(id) {
    Swal.fire({
        title: 'Delete this call record?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it',
    }).then((result) => {
        if (!result.isConfirmed) return;
        fetch(`/company/calls/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: data.message, showConfirmButton: false, timer: 2000 })
                    .then(() => location.reload());
            }
        })
        .catch(() => Swal.fire('Error', 'Could not delete the call record.', 'error'));
    });
}
</script>
@endsection
