@extends('layouts.dashboard')
@section('title', 'Campaigns - Supervisor')
@section('page_title', 'Campaigns')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($campaigns as $campaign)
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-start justify-between mb-3">
            <div><h3 class="text-sm font-bold text-gray-900 dark:text-white">{{ $campaign->name }}</h3><p class="text-xs text-gray-400">{{ ucfirst($campaign->type) }}</p></div>
            <span class="text-xs px-2 py-0.5 rounded-full {{ $campaign->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($campaign->status) }}</span>
        </div>
        <p class="text-sm text-gray-500 dash-text mb-3">{{ $campaign->description ?? 'No description' }}</p>
        <div class="text-xs text-gray-400 mb-3">Contacts: {{ $campaign->contacts_count }}</div>
        <a href="{{ route('supervisor.campaigns.show', $campaign) }}" class="block text-center px-3 py-1.5 text-xs font-medium border border-gray-200 dash-border rounded-lg hover:bg-gray-50 dash-hover text-gray-600 dash-text-strong">View Details</a>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No campaigns found.</div>
    @endforelse
</div>
{{ $campaigns->withQueryString()->links() }}
@endsection
