@extends('layouts.dashboard')
@section('title', $campaign->name)
@section('page_title', $campaign->name)

@section('content')
<div class="mb-6"><a href="{{ route('supervisor.campaigns.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Campaigns</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Campaign Contacts</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Contact</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Phone</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Agent</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Attempts</th><th class="text-left px-4 py-2 font-medium text-gray-500 dash-text">Status</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($campaign->contacts as $cc)
                <tr><td class="px-4 py-2 font-medium text-gray-900 dark:text-white">{{ $cc->contact->name }}</td><td class="px-4 py-2 text-gray-500 dash-text">{{ $cc->contact->phone }}</td><td class="px-4 py-2 text-gray-500 dash-text">{{ $cc->agent->name ?? 'Unassigned' }}</td><td class="px-4 py-2 text-gray-500 dash-text">{{ $cc->attempts }}</td><td class="px-4 py-2"><span class="text-xs px-2 py-0.5 rounded-full {{ $cc->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($cc->status) }}</span></td></tr>
                @empty
                <tr><td colspan="5" class="text-center py-8 text-gray-400">No contacts in this campaign.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
